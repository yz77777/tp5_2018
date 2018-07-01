<?php
namespace app\home\controller;
use app\home\logic;
use think\Config;
use think\Controller;
class Finance extends Controller
{
	public function index()
	{

		$pay_method = Config::get('common.pay_method');
		$income_method = Config::get('common.income_method');
		$consume_type = Config::get('common.consume_type');
//dump($pay_method);die;


		$this->assign('income_method',$income_method);
		$this->assign('consume_type',$consume_type);
		$this->assign('pay_method',$pay_method);

		return view();
	}
}