<?php
namespace app\home\model;
use think\model;

class memberModel extends Model
{
	protected $table = 'member';
	protected $resultSetType = 'collection';

	public function memberCount($where){

		return $this->where($where)->count();
	}

	public function memberPage($where, $page, $pageSize){
		return $this->field('member_id,nickname,realname,mobile,created_at')->where($where)->page($page)->limit($pageSize)->select()->toArray();
	}
}