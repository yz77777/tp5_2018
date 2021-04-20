<?php


namespace app\home\controller;


use app\home\logic\UserLogic;
use think\Controller;

class User extends Controller
{
	public function index() {
		return view();
	}

	public function login() {
		return view();
	}

	public function register() {
		return view();
	}

	public function registerSave() {
		$UserLogic = new UserLogic();
		$UserLogic->registerUser($_POST);
		return json(['code' => '200', 'message' => '', 'data' => '']);
	}
}