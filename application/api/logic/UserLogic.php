<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/11
 * Time: 下午4:49
 */

namespace app\api\logic;
use app\commonModel\UserModel;

class UserLogic
{
	public function login($param) {
		$email = $param['email'];
		$pwd = $param['pwd'];


		$UserModel = new UserModel();
		$userInfo = $UserModel->findUserWhere($email);

		if ($userInfo) {

		}
		return true;
	}
}