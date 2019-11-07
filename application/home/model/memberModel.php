<?php
namespace app\home\model;
use think\model;

class memberModel extends Model
{
	protected $table = 'member';

	public function memberCount($where){

		return $this->where($where)->count();
	}

	public function memberPage($where, $page, $pageLimit){
		return $this->field('member_id,nickname,realname,mobile,created_at')->where($where)->page($page)->limit($pageLimit)->select()->toArray();
	}
}