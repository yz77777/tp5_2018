<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/12
 * Time: 下午2:03
 */
namespace extend;

class ResponseBase
{
	public static function responseError($code, $message)
	{
		$res = ['code'=>$code, 'message'=>$message];
		var_dump($res);die;
//		echo json_encode($res);die;
	}
}