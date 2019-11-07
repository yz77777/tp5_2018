<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/1/22
 * Time: 下午2:14
 */
namespace app\home\controller;
use app\home\logic;

class testPaperController {

	public function index() {

		if (1==1) {


			$testPaperLogic = new logic\TestPaperLogic();

			$data = $testPaperLogic->getTextPaperQuestion();

			$assignArr = array(
				'show_answer' => 0,
			);
			$assignArr = array_merge($assignArr, $data);

			return view('literaryIntroductionOf', $assignArr);
		} else {

			return view();
		}
	}

	/**
	 * 交卷
	 */
	public function handAnswer() {

		$param = $_POST;

		$testPaperLogic = new logic\TestPaperLogic();

		$res = $testPaperLogic->handAnswer($param);

		echo json_encode($res, JSON_UNESCAPED_UNICODE);
		exit;
	}


}