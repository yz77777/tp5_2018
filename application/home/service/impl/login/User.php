<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/6/17
 * Time: 上午10:54
 */
namespace app\home\service\impl\login;
use app\home\service\impl\LoginAbstract;

class User extends LoginAbstract {

	public function login($loginAccount, $password) {
		echo '用户登陆成功';
	}
}