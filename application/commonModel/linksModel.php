<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2018/8/3
 * Time: 下午3:45
 */
namespace app\home\model;
use think\model;

class linksModel extends Model
{
	protected $table = 'yz_links';
//	protected $resultSetType = 'collection';

	public function myfind($where)
	{
//		$info = $this->where($where)->find();
//		echo $this->getLastSql();
		echo 111;
	}
}