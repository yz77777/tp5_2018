<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/12
 * Time: 下午3:43
 */
namespace app\commonModel;
use think\Exception;
use think\model;

class UserModel extends Model {

	protected $table = 'yz_user';

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

	public function getUserPageCount($where) {
		return $this->where($where)->count();
//		return $this->findAdmin(1);
	}

	public function getUserPageList($where, $page, $pageCount) {
		return $this->where($where)->page($page, $pageCount)->select()->toArray();
	}
}