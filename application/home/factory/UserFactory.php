<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/11/22
 * Time: 上午11:48
 */
namespace app\home\factory;
use app\home\factory\User;
class UserFactory {

	private $user;

	public function __construct($param)
	{
		$this->user = new User($param['userName'], $param['gender'], $param['job']);
	}

	public function getUser() {
		return $this->user;
	}
}