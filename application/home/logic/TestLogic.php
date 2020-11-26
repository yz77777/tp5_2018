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

	public function splitOrder() {

		$orderList = array(
			['order_id'=>1, 'deposit_amount'=>501, 'gift_amount'=>90,'prepay_card_id'=>12345],
			['order_id'=>2, 'deposit_amount'=>100, 'gift_amount'=>100,'prepay_card_id'=>12345],
		);
		$hegui = 1;
		$limitBalance= 500;

		$newOrderList = [];
		foreach ($orderList as $order) {
			$ext_deposit = [];
			$ext_gift = [];
			if ($hegui == 1) {
				$total_amount = bcadd($order['deposit_amount'], $order['gift_amount'], 2);

				if (bccomp($total_amount, $limitBalance) > 0) {
					$order['prepay_card_id']=0;
					$ext_deposit = $this->handleSplitAmount($order['order_id'],'deposit', $order['deposit_amount'], $limitBalance);
					$ext_gift = $this->handleSplitAmount($order['order_id'],'gift', $order['gift_amount'], $limitBalance);
				} else {
					$order['prepay_card_id'] = mt_rand(10000, 99999);
				}
			}
			$order['item_deposit']=$ext_deposit;
			$order['item_gift']=$ext_gift;

			$newOrderList[]=$order;
		}

		dump($newOrderList);
	}

	private function handleSplitAmount($orderId, $depositType, $amount, $balanceLimit) {
		$pageSize = ceil(bcdiv($amount, $balanceLimit, 2));
		$temp_amount = $amount;
		$ext = [];
		for ($i = 1; $i <= $pageSize; $i++) {
			if (bccomp($temp_amount, $balanceLimit) > 0) {
				$ext[] = [
					'order_id' => $orderId,
					'prepay_card_id' => mt_rand(10000, 99999),
					'deposit_amount' => $depositType == 'deposit' ? $balanceLimit : 0,
					'gift_amount' => $depositType == 'gift' ? $balanceLimit : 0,
				];
			} else {
				$ext[] = [
					'order_id' => $orderId,
					'prepay_card_id' => mt_rand(10000, 99999),
					'deposit_amount' => $depositType == 'deposit' ? $temp_amount : 0,
					'gift_amount' => $depositType == 'gift' ? $temp_amount : 0,
				];
				break;
			}
			$temp_amount = bcsub($temp_amount, $balanceLimit, 2);
		}
		return $ext;
	}

	/**
	 * 唯一分享token
	 * @param int $len
	 * @return array
	 */
	public function getToken($len=1) {
		$list = [];
		for ($i = 1; $i <= $len; $i++) {
			$list[] = md5(uniqid(md5(microtime(true)),true));
		}
		return $list;
	}

	/**
	 * 唯一订单号
	 * @param int $unique
	 * @return string
	 */
	public function getUUID($unique=0) {
		$orderIdMain = date('YmdHis') . mt_rand(10000000,99999999);
		$orderIdLen = strlen($orderIdMain);
		$orderIdSum = 0;
		for($i = 0; $i < $orderIdLen; $i++){
			$orderIdSum += (int)(substr($orderIdMain,$i,1));
		}
		return $orderIdMain . str_pad((100 - $orderIdSum % 100) % 100,2,'0',STR_PAD_LEFT);
	}
}