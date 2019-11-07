<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/12
 * Time: 下午3:51
 */
namespace app\home\logic;
use app\home\model\ModuleModel;
use app\home\model\RoleModuleRelationModel;
use app\home\model\UserModel;
use app\home\model\UserRoleRelationModel;

class AdminLogic {


	/**
	 * 获取用户权限
	 * @param $adminId
	 * @return array
	 * @throws \think\Exception
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getAdminAuth($adminId) {

		// 查询用户与角色关联
		$UserRoleRelationModel = new UserRoleRelationModel();
		$whereUserRole = array(
			'user_id' => $adminId
		);
		$userRoleRelationList = $UserRoleRelationModel->where($whereUserRole)->select()->toArray();
		$roleIdArr = array();
		foreach ($userRoleRelationList as $value) {
			$roleIdArr[] = $value['role_id'];
		}
		if (empty($roleIdArr)) {
			return array();
		}
//dump($roleIdArr);die;
		// 查询角色与功能模块关联
		$RoleModuleRelationModel = new RoleModuleRelationModel();
		$whereRole = array(
			'role_id' => array('in',$roleIdArr)
		);
		$roleModuleList = $RoleModuleRelationModel->where($whereRole)->select()->toArray();
//dump($roleModuleList);die;
		$moduleIdArr = array();
		foreach ($roleModuleList as $value) {
			$moduleIdArr[]=$value['module_id'];
		}
		if (empty($moduleIdArr)) {
			return array();
		}
//		dump($moduleIdArr);die;
		$ModuleModel = new ModuleModel();
		$moduleList = $ModuleModel->getModuleAuth($moduleIdArr);

		return $moduleList;
	}
}