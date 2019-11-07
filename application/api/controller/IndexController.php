<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/14
 * Time: 下午2:14
 */
namespace app\api\controller;

class IndexController {

	/**
	 * 初始化操作
	 * @access protected
	 */
	protected function _initialize()
	{
	}

	protected function ajaxReturn($data = array()) {
		if (empty($data)) {
			$data = array('code'=>2001,'message'=>'异常','data'=>[]);
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);exit;
	}
}