<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/11/22
 * Time: 下午2:23
 */
namespace app\home\factory;
use UserCreate;
class UserFactoryMan implements UserCreate {
	function create($param)
	{
		// TODO: Implement create() method.
		return new UserFactory($param);
	}
}