<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/8/27
 * Time: 下午4:04
 */
namespace app\home\controller;
use app\home\logic;
use think\Controller;
use think\Exception;
use think\db;

class AccountNumber extends Controller {


	public function index() {


		$accountNumberLogic = new logic\AccountNumberLogic();

		$accountNumberLogic->getAccountNumberList();
//
//echo 1;
		die;
	}

}