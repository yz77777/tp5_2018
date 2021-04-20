<?php


namespace app\common;


class Common
{
	/**
	 * 获取当前时间
	 * @return false|string
	 */
	public static function getTime() {
		return date('Y-m-d H:i:s');
	}
	/**
	 * 获取今天
	 * @return false|string
	 */
	public static function getToday() {
		return date('Y-m-d');
	}

	/**
	 * 获取昨天
	 * @return false|string
	 */
	public static function getYesterday() {
		return date('Y-m-d', strtotime('-1 day'));
	}

	/**
	 * 检查是否是日期
	 * @param String $onDate 2020-01-01 || 2020-01-01 11:11:11
	 * @return bool true 正确 || false 错误
	 */
	public static function checkDate(String $onDate) {
		return strtotime($onDate) ? true : false;
	}

	/**
	 * 获取每月的第一天
	 * @param null $onDate
	 * @return false|string
	 */
	public static function getMonthFirstDay($onDate=null) {
		if ($onDate) {
			return date('Y-m-01', strtotime($onDate));
		}
		return date('Y-m-01');
	}

	/**
	 * 获取每月的最后一天
	 * @param null $onDate
	 * @return false|string
	 */
	public static function getMonthLastDay($onDate=null) {
		if ($onDate) {
			return date('Y-m-t', strtotime($onDate));
		}
		return date('Y-m-t');
	}

	/**
	 * 获取每一天
	 * @return array
	 */
	public static function getEveryDay() {
		$list = [];
		$days = date('t');
		$thisDate = date('Y-m');
		for ($i = 1; $i <= $days; $i++) {
			$temp = (strlen($i) > 1) ? $i : '0'.$i;
			$list[]=$thisDate.'-'.$temp;
		}
		return $list;
	}

	/**
	 * 例子1
	 * $arr1 = ['a'=>10,'b'=>20,'d'=>40,'e'=>50];
	 * $arr_one = ['c'=>30];
	 * array_insert($arr1, 'd', $arr_one)
	 * ['a'=>10,'b'=>20,'c'=>30,'d'=>40,'e'=>50]
	 * 例子2
	 * $arr2 = [10,20,40,50];
	 * $arr2_one = [30];
	 * array_insert($arr2, 'd', $arr2_one)
	 * [10,20,30,40,50]
	 *
	 * 指定位置添加到数组中
	 * @param array $array
	 * @param string $position
	 * @param array $insert_array
	 */
	public static function array_insert (&$array, $position, $insert_array) {
		$keyArr = array_flip(array_keys($array));
		if (array_key_exists($position, $keyArr)) {
			$first_array = array_splice ($array, 0, $keyArr[$position]);
			$array = array_merge ($first_array, $insert_array, $array);
		} else {
			$array = array_merge($array, $insert_array);
		}
	}

	/**
	 * 保留二位小数，不四舍五入
	 * @param $decimalValue
	 * @return float|int
	 */
	public static function roundDown(float $decimalValue) {
		return floor($decimalValue * 100) / 100;
	}

	/**
	 * 元 转 分
	 * @param $amount 11.229
	 * @return false|float 1122
	 */
	public static function getFen(float $amount) {
		return floor($amount * 100);
	}

	/**
	 * 分 转 元
	 * @param float $amount
	 * @return float|int
	 */
	public static function getYuan(float $amount) {
		return $amount / 100;
	}

	/**
	 * 数组排序
	 * @param array $list
	 * @param string $key 排序字段key
	 * @param string $sort
	 * @return array
	 */
	public static function array_sort(array $list, string $key, $sort='asc') {
		$sortKeyList = array_column($list, $key);
		$sortKey = strtolower($sort) == 'asc' ? SORT_ASC : SORT_DESC;
		array_multisort($sortKeyList, $sortKey,  $list);
		return $list;
	}

	/**
	 * 字符串过滤
	 * @param String $str
	 * @return string
	 */
	public static function filterString(String $str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		return $str;
	}
}