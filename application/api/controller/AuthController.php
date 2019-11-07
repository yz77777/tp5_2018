<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/14
 * Time: 上午11:39
 */
namespace app\api\controller;
use app\api\logic\AuthLogic;

class AuthController extends IndexController {

	public function moduleCreate() {

		$AuthLogic = new AuthLogic();
		$res = $AuthLogic->moduleCreate($_POST);

		$this->ajaxReturn($res);
	}
}