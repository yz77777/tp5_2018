<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/6/17
 * Time: 上午10:54
 */
namespace app\home\service\impl\login;
use app\home\service\impl\LoginAbstract;

class QQ extends LoginAbstract {

	public function login($loginAccount, $password) {
		echo 'QQ登陆成功';
	}
}