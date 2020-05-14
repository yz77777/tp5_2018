<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/11
 * Time: 下午4:49
 */

namespace app\api\logic;
use app\common\exception\ExceptionBase;
use app\commonModel\UserModel;
use think\Session;

class UserLogic
{
	/**
	 * @param $param
	 * @return bool
	 */
	public function login($param) {
		$email = $param['email'];
		$pwd = $param['pwd'];

		$UserModel = new UserModel();
		$userInfo = $UserModel->findUserWhere($email);

		if ($userInfo) {
			Session::set('user', $userInfo);
		} else {
			throw new ExceptionBase(STATUS_PARAM_WARNING, '用户不存在');
		}
		return true;
	}
}