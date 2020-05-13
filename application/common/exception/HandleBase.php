<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/12
 * Time: 上午11:43
 */
namespace app\common\exception;
use think\exception\Handle;
use think\config;
use wyz\ResponseBase;
use app\common;
class HandleBase extends Handle
{
	private $code;

	private $message;

	public function __construct()
	{
	}

	public function render(\Exception $e) {
		// 参数验证错误
		if ($e instanceof ExceptionBase) {
//			return json($e->getError(), 422);
			$this->code = $e->getCode();

			$msg = '';
			if ($e->getMessage() != '') {
				$msg = $e->getMessage();
			} else {
				$msg = commonGetStatusMessage($this->code);
			}
			$this->message = $msg;
		} else {
			//判断配置中的dbug是否开启确定开发或生产模式
			if (Config::get('app_debug')) {
				//如果是开发模式
//				return parent::render($e);
				$this->code = $e->getCode();
				$this->message = $e->getMessage();
			} else {
				//如果是生产模式,则返回与设定好的未知错误的json
				$this->code = 500;
				$this->message = 'Unknown Error';
			}
		}

		//TODO 全局的记录日志

		// 请求异常
		if ((request()->isAjax() || request()->isPost())) {
			ResponseBase::responseError($this->code, $this->message);
		} else {
			return parent::render($e);
		}



	}
}