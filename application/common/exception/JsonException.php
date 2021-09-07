<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/4/20
 * Time: 下午5:41
 */


namespace app\common\exception;


use Exception;
use think\Config;
use think\exception\ErrorException;
use think\exception\Handle;
use think\exception\HttpException;
use think\console\Output;
use think\Response;


class JsonException extends Handle
{
	protected $render;
	protected $ignoreReport = [
		'\\think\\exception\\HttpException',
	];

	public function setRender($render)
	{
		$this->render = $render;
	}

	/**
	 * Report or log an exception.
	 *
	 * @access public
	 * @param \Exception $exception
	 * @return void
	 */
	public function report(Exception $exception)
	{
		if (!$this->isIgnoreReport($exception)) {
			// 收集异常数据
			if (Config::get('app_debug')) {
				$data = [
					'file' => $exception->getFile(),
					'line' => $exception->getLine(),
					'message' => $this->getMessage($exception),
					'code' => $this->getCode($exception),
				];
				$log = "[{$data['code']}]{$data['message']}[{$data['file']}:{$data['line']}]";
			} else {
				$data = [
					'code' => $this->getCode($exception),
					'message' => $this->getMessage($exception),
				];
				$log = "[{$data['code']}]{$data['message']}";
			}

			if (Config::get('record_trace')) {
				$log .= "\r\n" . $exception->getTraceAsString();
			}

//			Config::get('log')->record($log, 'error');
		}
	}

	protected function isIgnoreReport(Exception $exception)
	{
		foreach ($this->ignoreReport as $class) {
			if ($exception instanceof $class) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @access public
	 * @param \Exception $e
	 * @return Response
	 */
	public function render(Exception $e)
	{
		if ($this->render && $this->render instanceof \Closure) {
			$result = call_user_func_array($this->render, [$e]);

			if ($result) {
				return $result;
			}
		}

		if ($e instanceof HttpException) {
			return $this->renderHttpException($e);
		} else {
			return $this->convertExceptionToResponse($e);
		}
	}

	/**
	 * @access public
	 * @param Output $output
	 * @param Exception $e
	 */
	public function renderForConsole(Output $output, Exception $e)
	{
		if (Config::get("app_debug")) {
			$output->setVerbosity(Output::VERBOSITY_DEBUG);
		}

		$output->renderException($e);
	}

	/**
	 * @access protected
	 * @param HttpException $e
	 * @return Response
	 */
	protected function renderHttpException(HttpException $e)
	{
		$status = $e->getStatusCode();
		$template = Container::get('app')->config('http_exception_template');

		if (!Container::get('app')->isDebug() && !empty($template[$status])) {
			return Response::create($e, 'json', $status);
		} else {
			return $this->convertExceptionToResponse($e);
		}
	}

	/**
	 * @access protected
	 * @param Exception $exception
	 * @return Response
	 */
	protected function convertExceptionToResponse(Exception $exception)
	{
		// 收集异常数据
		if (config('app_debug')) {
			// 调试模式，获取详细的错误信息
			$data = [
				'name' => get_class($exception),
				'file' => $exception->getFile(),
				'line' => $exception->getLine(),
				'message' => $this->getMessage($exception),
				'trace' => $exception->getTrace(),
				'code' => $this->getCode($exception),
				'source' => $this->getSourceCode($exception),
				'datas' => $this->getExtendData($exception),
				'tables' => [
					'GET Data' => $_GET,
					'POST Data' => $_POST,
					'Files' => $_FILES,
					'Cookies' => $_COOKIE,
					'Session' => isset($_SESSION) ? $_SESSION : [],
					'Server/Request Data' => $_SERVER,
					'Environment Variables' => $_ENV,
					'ThinkPHP Constants' => $this->getConst(),
				],
			];
		} else {
			// 部署模式仅显示 Code 和 Message
			$data = [
				'code' => $this->getCode($exception),
				'message' => $this->getMessage($exception),
			];

			if (!config('show_error_msg')) {
				// 不显示详细错误信息
				$data['message'] = config('error_message');
			}
		}

		//保留一层
		while (ob_get_level() > 1) {
			ob_end_clean();
		}

		$data['echo'] = ob_get_clean();

		$response = Response::create($data, 'json');

		if ($exception instanceof HttpException) {
			$statusCode = $exception->getStatusCode();
			$response->header($exception->getHeaders());
		}

		if (!isset($statusCode)) {
			$statusCode = 500;
		}
		$response->code($statusCode);

		return $response;
	}

	/**
	 * 获取错误编码
	 * ErrorException则使用错误级别作为错误编码
	 * @access protected
	 * @param \Exception $exception
	 * @return integer                错误编码
	 */
	protected function getCode(Exception $exception)
	{
		$code = $exception->getCode();

		if (!$code && $exception instanceof ErrorException) {
			$code = $exception->getSeverity();
		}

		return $code;
	}

	/**
	 * 获取错误信息
	 * ErrorException则使用错误级别作为错误编码
	 * @access protected
	 * @param \Exception $exception
	 * @return string                错误信息
	 */
	protected function getMessage(Exception $exception)
	{
		$message = $exception->getMessage();

		if (PHP_SAPI == 'cli') {
			return $message;
		}

		$lang = Config::get('lang');

		if ($lang != null) {
			if (strpos($message, ':')) {
				$name = strstr($message, ':', true);
				$message = $lang->has($name) ? $lang->get($name) . strstr($message, ':') : $message;
			} elseif (strpos($message, ',')) {
				$name = strstr($message, ',', true);
				$message = $lang->has($name) ? $lang->get($name) . ':' . substr(strstr($message, ','), 1) : $message;
			} elseif ($lang->has($message)) {
				$message = $lang->get($message);
			}
		}

		return $message;
	}

	/**
	 * 获取出错文件内容
	 * 获取错误的前9行和后9行
	 * @access protected
	 * @param \Exception $exception
	 * @return array                 错误文件内容
	 */
	protected function getSourceCode(Exception $exception)
	{
		// 读取前9行和后9行
		$line = $exception->getLine();
		$first = ($line - 9 > 0) ? $line - 9 : 1;

		try {
			$contents = file($exception->getFile());
			$source = [
				'first' => $first,
				'source' => array_slice($contents, $first - 1, 19),
			];
		} catch (Exception $e) {
			$source = [];
		}

		return $source;
	}

	/**
	 * 获取异常扩展信息
	 * 用于非调试模式html返回类型显示
	 * @access protected
	 * @param \Exception $exception
	 * @return array                 异常类定义的扩展数据
	 */
	protected function getExtendData(Exception $exception)
	{
		$data = [];

		if ($exception instanceof \think\Exception) {
			$data = $exception->getData();
		}

		return $data;
	}

	/**
	 * 获取常量列表
	 * @access private
	 * @return array 常量列表
	 */
	private static function getConst()
	{
		$const = get_defined_constants(true);

		return isset($const['user']) ? $const['user'] : [];
	}

}