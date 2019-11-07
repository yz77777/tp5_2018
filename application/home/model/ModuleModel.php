<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/12
 * Time: 下午3:43
 */
namespace app\home\model;
use think\model;

class ModuleModel extends Model {

	public function getModuleAuth($moduleIdArr) {
		$moduleIdArr = array_unique($moduleIdArr);
		$where = array(
			'module_id' => array('in', $moduleIdArr),
		);
		$list = $this->where($where)->select()->toArray();
//dump($moduleIdArr);
//dump($list);
//die;
		$newList = array();
		foreach ($list as $value) {
			$newList[]=$value['module_code'].'_'.$value['module_auth'];
		}
		return $newList;
	}
}