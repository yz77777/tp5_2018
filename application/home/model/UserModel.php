<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/12
 * Time: 下午3:43
 */
namespace app\home\model;
use think\Exception;
use think\model;

class UserModel extends Model {

	/**
	 * 查询用户
	 * @param $adminId
	 * @return array
	 * @throws Exception
	 */
	public function findAdmin($adminId) {
		try {
			$user = $this->get($adminId);
		} catch (Exception $exception) {
			return array();
		}
		if (empty($user)) {
			return array();
		}
		return $user->toArray();
	}
}