<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/5/11
 * Time: 下午12:15
 */
namespace app\home\controller;
use app\home\logic\UserLogic;
use think\Controller;

class UserController extends Controller
{
	public function login() {

		$userLogic = new UserLogic();
		$userLogic->findUser(1);
		return view();
	}
}