<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/6/11
 * Time: 下午2:02
 */

namespace app\home\controller;


class ToolController
{
	public function index() {
		return view();
	}

	/**
	 * 下划线转驼峰
	 * @param $str
	 * @return null|string|string[]
	 */
	public function underlineToHump($str) {
		$resString = preg_replace_callback('/_+([a-z])/',function($matches){
			return strtoupper($matches[1]);
		},$str);
		dump($resString);
		die;
	}

	/**
	 * 驼峰转下划线
	 * @param $str
	 */
	public function humpToUnderline($str) {
		$resString = strtolower(preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $str));

		dump($resString);
		die;
	}

}