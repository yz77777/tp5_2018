<?php


namespace app\home\logic;


use app\common\exception\BusinessException;
use app\home\model\UserModel;
use think\Exception;

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
		if (empty($userData)) {
			throw new BusinessException('注册失败', '10000');
//			throw new Exception("参数为空");
		}
		$UserModel = new UserModel();
		$ret = $UserModel->addUser($userData);
		if ($ret < 1) {
//			throw new BusinessException('注册失败', '10000');
//			throw new \think\Exception('异常消息', 100006);

		}
		return true;
	}
}