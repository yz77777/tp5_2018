<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/6/17
 * Time: 上午10:10
 */
namespace app\home\service\impl;

use app\home\service\LoginService;

class LoginServiceImpl implements LoginService {

	public function userLogin($phone, $password) {
		if (strlen(trim($phone)) < 1) {
			return false;
		}

		return true;
	}
}