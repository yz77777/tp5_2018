<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/12
 * Time: 下午1:38
 */

namespace app\common\exception;
use think\Exception;
use Throwable;

class ExceptionBase extends Exception
{

	public function __construct($code = -1, $message = "", Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}
}