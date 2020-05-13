<?php
/**
 * Created by PhpStorm.
 * User: mydn
 * Date: 2020/5/12
 * Time: 下午3:55
 */

namespace app\common\behavior;


use think\Config;

class StatusBehavior
{
	public function run()
	{
		$codeList = Config::get('status.code');
		foreach ($codeList as $key => $value) {
			define('STATUS_'.$key, $value);
		}
	}
}