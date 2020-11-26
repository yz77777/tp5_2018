<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/12
 * Time: 下午2:03
 */
namespace wyz;
use think\Response;
class ResponseBase
{

	public static function responseError($code, $message)
	{
		header('Content-Type:application/json;charset=UTF-8');

		$res = ['code'=>$code, 'message'=>$message];

		echo json_encode($res, JSON_UNESCAPED_UNICODE);
		die;
	}
}