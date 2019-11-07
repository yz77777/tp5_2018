<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/14
 * Time: 下午4:58
 */
namespace app\home\logic;
use app\commonModel\model\ModuleModel;
use app\commonModel\model\ModuleNameModel;
use app\commonModel\model\RoleModuleRelationModel;

class AuthLogic {

	public function getRoleModuleList($roleId) {

//		$RoleModuleRelationModel = new RoleModuleRelationModel();
//		$list = $RoleModuleRelationModel->where(['role_id'=>$roleId])->select()->toArray();

		$ModuleModel = new ModuleModel();
		$moduleList = $ModuleModel->select()->toArray();
//		dump($moduleList);

		$ModuleNameModel = new ModuleNameModel();
		$moduleNameList = $ModuleNameModel->field(['module_code','module_name'])->select()->toArray();

		$groupModuleName = [];
		foreach ($moduleNameList as $value) {
			$groupModuleName[$value['module_code']]=$value['module_name'];
		}

		$group = [];
		$tempArr = [];
		foreach ($moduleList as $value) {
			$moduleCode = $value['module_code'];
			$moduleAuth = $value['module_auth'];

			$tempArr[$moduleCode][]=array(
				'code'=>$moduleAuth,
				'name'=>isset($groupModuleName[$moduleAuth])?$groupModuleName[$moduleAuth]:$moduleAuth
			);
			$group[$moduleCode]= array(
				'code' => $moduleCode,
				'name' => isset($groupModuleName[$moduleCode])?$groupModuleName[$moduleCode]:$moduleCode,
				'list'=>$tempArr[$moduleCode]
			);
		}

		$modules = array(
			'list'=>$group,
		);

//		dump($modules['list']);
//		die;
		return $modules;
	}
}