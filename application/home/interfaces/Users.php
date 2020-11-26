<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/9/21
 * Time: 下午7:32
 */
namespace app\home\interfaces;
class Users implements User
{
	public function findUser($userId)
	{
		// TODO: Implement findUser() method.
		return ['user_id'=>1,'name'=>'jack','age'=>'30'];
	}

	public function getName($userId) {
		$userInfo = $this->findUser($userId);
		return $userInfo ? $userInfo['name'] : '';
	}
}