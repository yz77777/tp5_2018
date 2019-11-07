<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/12
 * Time: 下午3:50
 */
namespace app\home\controller;
use app\home\logic\AdminLogic;
use think\controller;
class AdminController extends Controller {

	/**
	 *
	 */
	public function index() {

		$adminLogic = new AdminLogic();
		$adminAuth = $adminLogic->getAdminAuth(3);

		dump($adminAuth);
	}

	public function moduleAdd() {
//echo 1;die;
		return $this->fetch();
	}
}