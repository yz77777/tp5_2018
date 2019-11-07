<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/10/14
 * Time: 下午4:25
 */
namespace app\home\controller;
use app\home\logic\AuthLogic;
use think\Controller;

class AuthController extends Controller {

	public function index() {

		$str = '';
		/*for ($i=1;$i<= 10000;$i++) {
			$str .= "('userCode_{$i}','openId_{$i}','test6_小xie{$i}')";
			if ($i != 9999) {
				$str .= ',';
			}
		}*/
		/*for ($i=626;$i<= (10624);$i++) {
			$str .= $i;
			if ($i != (10624)) {
				$str .= ',';
			}
		}*/
		$a = [];
		$start='2019-11-01';
		$end='2019-12-31';
		$dateList = $this->getDateFromRange($start,$end);
//dump($dateList);die;
//		dump(implode(',',$dateList));die;
		// (create_date, max_order_create_time, city_id, city_name, hotel_id, hotel_name, hotel_type, star, gmv, sell_cnt, dw_create_time)
		$createDate = ['23:59:59','10:11:00','13:55:06','21:17:09'];
		$arr = ['23:59:59','10:11:00','13:55:06','21:17:09'];
		$values = [];
		$tempHotelId = [];
		for ($i=1;$i<10;$i++) {
			$createDate = $dateList[mt_rand(0,60)];
			$hotelId = mt_rand(100000,999999);
			$gmv = mt_rand(0,99999);
			$time = '20:20:20';
			$createTime = date('Y-m-d H:i:s');
			if (array_key_exists($createDate, $arr)) {
				$time = $arr[$createDate];
			}
			if (in_array($hotelId.'_'.$createDate, $tempHotelId)) {
				continue;
			}
			$tempHotelId[]=$hotelId.'_'.$createDate;

			$values[]= "('{$createDate}','{$createDate} {$time}','zkt',0,'测试省',{$hotelId},'测试酒店-{$hotelId}','common',0,{$gmv},0,'{$createTime}')";
		}

		dump(implode(',',$values));
//		dump($values);

		die;
		return view();
	}

	public function roleModuleBind(){

		$AuthLogic = new AuthLogic();
		$modules = $AuthLogic->getRoleModuleList(1);

		$this->assign('modules',$modules);
		return view();
	}

	function getDateFromRange($startdate, $enddate){

		$stimestamp = strtotime($startdate);
		$etimestamp = strtotime($enddate);

		// 计算日期段内有多少天
		$days = ($etimestamp-$stimestamp)/86400+1;

		// 保存每天日期
		$date = array();

		for($i=0; $i<$days; $i++){
			$date[] = date('Y-m-d', $stimestamp+(86400*$i));
		}

		return $date;
	}
}