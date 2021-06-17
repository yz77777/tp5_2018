<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/6/17
 * Time: 上午10:08
 */
namespace app\home\service;

interface LoginService {

	/**
	 * 用户登陆
	 * @param string $phone
	 * @param string $password
	 * @return boolean
	 */
	public function userLogin($phone, $password);
}