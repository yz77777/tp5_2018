<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/11/11
 * Time: 下午2:38
 */
namespace app\home\logic;
use app\commonModel;
class TestLogic {

	public function logAdd() {

		$list1 = [
			['id'=> 1,'my'=>1],
		];

		$list2 = [
			['id'=>1,'my'=>2],
		];


		$arr = array(
			'id'=>1,
			'name'=>'谢',
			'arr' => array(
				'class'=>1,
				'arr1' => array(
					'a'=>'t'
				)
			),
			'list' => $list1
		);
		$arr2 = array(
			'id'=>1,
			'name'=>'吴',
			'arr' => array(
				'class'=>2,
				'arr1' => array(
					'a'=>'s'
				)
			),
			'list' => $list2
		);
//		$arr2 = [];
//		dump(count($arr));
//		die;
//		dump(count($list2,1));

//		$json1 = json_encode($arr, JSON_UNESCAPED_UNICODE);
//		$json2 = json_encode($arr2, JSON_UNESCAPED_UNICODE);


		$diff = $this->diffFun($arr, $arr2);
//		$this->diffFunArrList($arr['list'], $arr2['list'], ['id']);

		dump($diff);
		die;
	}

	private function diffFun($arr1, $arr2, $diffKey = '', $diffArr = []) {
		// 新增
		if (empty($arr2)) {
			return $arr1;
		}

		foreach ($arr1 as $key => $value) {

			if (is_array($arr1[$key])) {
				if (array_key_exists(0, $arr1[$key])) {

				} else {

					$diffArr1 = $this->diffFun($arr1[$key], $arr2[$key], $key,empty($diffKey) ? $diffArr : $diffArr[$diffKey]);
					if (!empty($diffKey)) {
						$diffArr[$diffKey] = $diffArr1;
					} else {
						$diffArr = $diffArr1;
					}
				}
			} else {
				if ($arr1[$key] != $arr2[$key]) {
					if (!empty($diffKey)) {
						$diffArr[$diffKey][$key] = $arr1[$key];
					} else {
						$diffArr[$key] = $arr1[$key];
					}
				}
			}
		}

		return $diffArr;
	}

	private function diffFunArrList($arr1, $arr2, $uniqueKeyArr) {
		$group1 = $this->getGroup($arr1, $uniqueKeyArr);
		$group2 = $this->getGroup($arr2, $uniqueKeyArr);

		$add = [];
		$delete = [];
		$edit = [];

		foreach ($group1 as $key => $value) {

			$this->diffFun($value, $group2[$key]);
		}


		dump($group1);
		dump($group2);

		die;

	}

	private function getGroup($arr, $uniqueKeyArr) {
		$group = [];
		foreach ($arr as $value) {
			$tempUniqueKeyArr = [];
			foreach ($uniqueKeyArr as $v) {
				$tempUniqueKeyArr[] = $value[$v];
			}
			$tempUniqueKeyStr = implode('_',$tempUniqueKeyArr);

			$group[$tempUniqueKeyStr]=$value;
		}
		return $group;
	}

	public function insertUser() {
		$UserModel = new commonModel\UserModel();

		$dataList = [];

		for ($i = 1; $i <= 10; $i++) {
			$dataList[] = array(
				'user_name' => 'AA_'.$i,
				'phone' => mt_rand(10000000000, 99999999999),
				'create_time' => date('Y-m-d H:i:s'),
				'update_time' => date('Y-m-d H:i:s')
			);
		}

		$a = $UserModel->addUserAll($dataList);
		dump($a);
	}
}