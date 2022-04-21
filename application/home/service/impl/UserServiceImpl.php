<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2022/4/21
 * Time: 下午5:58
 */
namespace app\home\service\impl;
use app\home\service\UserService;
use app\model\UserModel;
class UserServiceImpl implements UserService {

	public function findUserById($userId) {
		$userModel = new UserModel();
		$userInfo = $userModel->findAdmin($userId);
		dump($userInfo);
	}
}