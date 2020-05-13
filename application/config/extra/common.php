<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/9/11
 * Time: 下午3:49
 */

/**
 * 根据状态code 获取对应的文案
 * @param $code
 * @return string
 */
function commonGetStatusMessage($code) {
	$messageList = config('status.message');
	return array_key_exists($code, $messageList) ? $messageList[$code] : '操作失败';
}