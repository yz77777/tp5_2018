<?php


namespace app\home\model;


use think\Model;

class UserModel extends Model
{
	protected $table = 'y_user';

	public function findUser($data)
	{
		if ($data == null || !is_array($data) || count($data) < 1) {
			return null;
		}
		return $this->where($data)->find();
	}

	public function addUser($userData) {
		return $this->save($userData);
	}
}