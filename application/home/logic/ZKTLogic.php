<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/9/23
 * Time: 下午5:42
 */
namespace app\home\logic;
use app\home\model;
class ZKTLogic {

	public function getVisitExpectLowerLevel($visitContentType){

		if (empty($visitContentType)) {
			return '';
		}

		$contentTypeArr = array();
		try {
			$contentTypeArr = json_decode($visitContentType, true);
		} catch (Exception $exception) {
		}

		$configStr = '{"1":"日历房","2":"储值卡","3":"常规自助餐","4":"自助餐大包装","5":"客房套餐","6":"抢购产品","7":"会员日产品","8":"前厅","9":"餐饮","10":"财务","11":"预订部","12":"公关","13":"销售","14":"其他"}';

		$str = "";
		if (is_array($contentTypeArr) && $contentTypeArr) {
//			$groupList = model('crm_visit_type')->getVisitTypeGroup();
			$groupList = $this->getVisitPurposeOne();
			$contentTypeArr2 = array();

			foreach ($contentTypeArr as $item) {

				foreach ($item as $key=>$value) {
					// 二级
					if (array_key_exists($key, $groupList)) {
						$s1 = $groupList[$key];
					} else {
						$s1 = $key;
					}

					// 三级
					$s2 = '';
					if ($value) {
						$a1 = array();
						foreach ($value as $v) {
							if (array_key_exists($v, $groupList)) {
								$a1[]=$groupList[$v];
							} else {
								$a1[]=$v;
							}
						}
						$s2 = " - ". implode("/", $a1);
					}
					// 拼装
					$contentTypeArr2[] = $s1.$s2;
				}
			}
			$str = implode("<br/>", $contentTypeArr2);
		} else {

//			$list = model('mm_daily_visit')->getContentType();
			$list = json_decode($configStr, true);
			$contentTypeArr = explode(',', $visitContentType);
			$arr = array();
			foreach ($contentTypeArr as $v) {
				if (array_key_exists($v, $list)) {
					$arr[] = $list[$v];
				} else {
					$arr[] = $v;
				}
			}
			$str = implode('/', $arr);
		}
		return $str;
	}

	public function getVisitPurposeOne($key='') {
		$configStr2 = '{"1":"签约","2":"产品采购、生意回顾","3":"培训","4":"物料铺设、门票培训、其他","5":"初次沟通","6":"关键人沟通","7":"管理层宣讲","8":"签合同","9":"产品采购","10":"生意回顾","11":"培训部门","12":"培训内容","13":"物料铺设","14":"门票培训","15":"其他","16":"日历房","17":"储值卡","18":"常规自助餐","19":"大包装","20":"抢购产品","21":"客房套餐","22":"其他","23":"前厅部","24":"预订部","25":"餐饮部","26":"销售部","27":"财务部","28":"公关部","29":"其他部门","30":"全员培训","31":"日历房","32":"储值卡","33":"常规自助餐","34":"客房套餐","35":"抢购","36":"系统使用","37":"客房点餐","38":"微信预授权","39":"餐厅点餐","40":"其他"}';

		$list = json_decode($configStr2, true);

		if ($key) {
			if (array_key_exists($key, $list)) {
				return $list[$key];
			} else {
				return $key;
			}
		}

		return $list;
	}

	public function active_status_opt($key = '')
	{
		$map = [
			'active' => '已上线',
			'inactive' => '未上线',
		];

		if ($key) {
			return isset($map[$key]) ? $map[$key] : $key;
		} else {
			return $map;
		}
	}
}