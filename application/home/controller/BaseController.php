<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/14
 * Time: 上午9:41
 */

namespace app\home\controller;


use think\Controller;
use think\Request;
use think\Session;

class BaseController extends Controller
{
	public function __construct(Request $request = null)
	{
		parent::__construct($request);
		$this->loginExpire();
	}

	/**
	 * 登陆信息有效期处理
	 */
	private function loginExpire() {
		$sessionName = 'user';
		if (Session::has($sessionName)) {
			$userInfo = Session::get($sessionName);
			Session::flash($sessionName, $userInfo);
		}
	}

}