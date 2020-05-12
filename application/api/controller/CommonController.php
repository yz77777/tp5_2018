<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/11
 * Time: 下午4:07
 */

namespace app\api\controller;


use think\Controller;

class CommonController extends Controller
{
//	public function __construct() {}



	protected function responseSuccess($data=null) {
		$res = ['code'=>'200', 'message'=>'成功', 'data'=>$data];
		return $res;
	}
	protected function responseFail($code = '10000', $message = '', $data=[]) {
		$res = ['code'=>$code, 'message'=>$message, 'data'=>$data];
		return $res;
	}
}