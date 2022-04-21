<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2022/4/21
 * Time: 下午5:57
 */
namespace app\home\service;
interface UserService {

	/**
	 * 根据用户查询
	 * @param $userId
	 * @return mixed
	 */
	public function findUserById($userId);
}