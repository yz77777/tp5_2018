<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/11
 * Time: 下午2:19
 */

namespace app\api\controller;
use think\Request;
use app\api\logic\UserLogic;

class UserController extends CommonController
{
	/**
	 * @return array
	 */
	public function login() {
		$request = Request::instance();
		$paramPost = $request->post();

		$UserLogic = new UserLogic();
		$res = $UserLogic->login($paramPost);

		return $this->responseSuccess($res);
	}
}