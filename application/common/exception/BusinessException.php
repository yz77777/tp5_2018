<?php


namespace app\common\exception;



class BusinessException extends \RuntimeException
{
	private $message;
	private $code;

	public function __construct($message = "", $code = 0, \Exception $previous = null)
	{
		$this->message = $message;
		$this->code = $code;
		parent::__construct($message, $code, $previous);
	}

}