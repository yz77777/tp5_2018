<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/4/23
 * Time: 上午11:07
 */
namespace app\home\controller;
use think\Controller;
class ListController extends Controller {

	public function js() {

		$this->assign('types', 'js');
		return view('index');
	}

	public function php() {
		$this->assign('types', 'php');
		return view('index');
	}

	public function mysql() {
		$this->assign('types','mysql');
		return view('index');
	}

	public function linux() {
		$this->assign('types','linux');
		return view('index');
	}

	public function top() {

		return view();
	}
}