<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/1/10
 * Time: 上午11:07
 */
namespace app\home\logic;

use app\model\UserModel;

class UserLogic {

	public function findUser($userId) {
		$userModel = new UserModel();
		$userInfo = $userModel->findAdmin($userId);
		dump($userInfo);
	}

}