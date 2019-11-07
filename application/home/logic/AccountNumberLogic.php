<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/8/27
 * Time: 下午4:56
 */
namespace app\home\logic;
use app\home\model;
class AccountNumberLogic {

	public function getAccountNumberList() {

		$accountNumberModel = new model\AccountNumberModel();

		$list = $accountNumberModel->getAccountNumberList();

		var_dump($list);
	}
}