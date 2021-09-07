<?php


namespace app\common\exception;



class BusinessException extends \Exception
{
	protected $message;
	protected $code;

	public function __construct($message = "", $code = 0, \Exception $previous = null)
	{
		$this->message = $message;
		$this->code = $code;
		parent::__construct($this->message, $this->code, $previous);
	}

}