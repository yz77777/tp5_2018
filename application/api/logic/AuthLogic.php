<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/14
 * Time: 下午2:57
 */
namespace app\api\logic;

use app\commonModel\model\ModuleModel;

class AuthLogic {

	/**
	 * 创建模块
	 * @param $request
	 * @return array
	 * @throws \think\Exception
	 */
	public function moduleCreate($request) {
		$res = ['code' => 2001,'message'=>''];
		if (empty($request['module_code'])) {
			$res['message'] = '请填写模块';
			return $res;
		}

		if (empty($request['module_auth']) || !is_array($request['module_auth'])) {
			$res['message'] = '请选择权限';
			return $res;
		}

		$ModuleModel = new ModuleModel();
		$num = $ModuleModel->where(['module_code' => $request['module_code']])->count();
		if ($num > 0) {
			$res['message'] = '该模块已存在';
			return $res;
		}

		$authArr = ['view','add','update','down'];

		// 入表
		$addData = [];
		foreach ($request['module_auth'] as $value) {
			if (!in_array($value, $authArr)) {
				$res['message'] = "（{$value}）该权限暂不支持";
				return $res;
			}
			$addData[] = [
				'module_code' => $request['module_code'],
				'module_auth' => $value,
			];
		}
		if (count($addData) < 1) {
			$res['message'] = '数据异常';
			return $res;
		}

		$ModuleModel->saveAll($addData,false);

		$res['code'] = 2000;
		return $res;
	}

//	public function
}