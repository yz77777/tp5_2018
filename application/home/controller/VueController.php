<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/11/20
 * Time: 下午4:07
 */
namespace app\home\controller;
use think\Controller;

class VueController extends Controller {

	public function index() {

		return view();
	}

	public function userInfoView() {

		return view();
	}

	public function form($type) {

		return view('form-'.$type);
	}
}