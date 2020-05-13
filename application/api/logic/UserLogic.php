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

class UserLogic
{
	/**
	 * @param $param
	 * @return bool
	 */
	public function login($param) {
		$email = $param['email'];
		$pwd = $param['pwd'];

//		throw new \extend\BaseException([]);

//		throw new BaseException(['error'=>'aaa']);


//		throw new BaseException('aaaa', 111);
//		throw new \BaseException();

//
		$UserModel = new UserModel();
		$userInfo = $UserModel->findUserWhere($email);

//dump($userInfo);die;
//		throw new ExceptionBase(STATUS_SUCCESS);


		if ($userInfo) {

		} else {
			throw new ExceptionBase(STATUS_PARAM_WARNING);
		}
		return true;
	}
}