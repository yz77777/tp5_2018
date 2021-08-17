<?php


namespace app\home\logic;


use app\common\exception\BusinessException;
use app\home\model\UserModel;

class UserLogic
{
	public function getUserInfo() {
		$UserModel = new UserModel();

		$userInfo = $UserModel->findUser(['mobile' => '13439771795']);


		return $userInfo;
	}

	public function registerUser($param) {
		$userData = [

		];
		$UserModel = new UserModel();
		$ret = $UserModel->addUser($userData);
		if ($ret < 1) {
			throw new BusinessException('注册失败', '10000');
		}
		return true;
	}
}