<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/12/24
 * Time: 下午1:57
 */
namespace app\home\controller;

use think\Validate;

class FormController {

	public function index() {

		$rule = [
			'name'  => 'require|max:25',
			'age'   => 'number|integer|between:0,100',
			'email' => 'email',
		];

		$field = [
			'name'  => '名称',
			'age'  => '年龄',
			'email'  => '邮箱',
		];

		$data = [
			'name'  => '',
			'age'   => -1,
			'email' => 'thinkphp@qq.com',
		];

		$validate = new Validate($rule, [], $field);

		if (!$validate->check($data)) {
			dump($validate->getError());
		}

		return view();
	}

	public function formSetting() {



//		return json(['code' => 200, 'message' => '成功', 'data'=>$result]);
	}
}