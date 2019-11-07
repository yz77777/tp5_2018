<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/12
 * Time: 下午3:43
 */
namespace app\home\model;
use think\Config;
use think\model;

class RoleModuleRelationModel extends Model {

	public function getRoleModule($roleIdArr) {


		$where = array(
			'role_id' => $roleIdArr
		);

//		$sql = "select * from {$roleModuleRelation} left join ";
//		$list = $this->query($sql);
//		dump($list);


		$list = $this->where($where)->selectOrFail()->toArray();
//		echo $this->getLastSql();



		dump($moduleIdArr);

	}
}