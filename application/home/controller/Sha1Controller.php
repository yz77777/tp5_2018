<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/1/19
 * Time: 下午6:58
 */
namespace app\home\controller;
class Sha1Controller {
	public function index() {

		$str = $this->getSignature('a','www');
		dump($str);
		exit;
	}

	function getSignature($key, $dataString) {
		$hmac = '';
		if (function_exists('hash_hmac')) {
			// php version >= 7.2  不然加密出来的结果和java不一样
			$hmac = hash_hmac("sha1", $dataString, $key, true);
		} else {
			$blocksize = 64;
			$hashfunc = 'sha1';
			if (strlen($key) > $blocksize) {
				$key = pack('H*', $hashfunc($key));
			}
			$key = str_pad($key, $blocksize, chr(0x00));
			$ipad = str_repeat(chr(0x36), $blocksize);
			$opad = str_repeat(chr(0x5c), $blocksize);
			$hmac = pack(
				'H*', $hashfunc(
					($key ^ $opad) . pack(
						'H*', $hashfunc(
							($key ^ $ipad) . $dataString
						)
					)
				)
			);
		}
//		return base64_encode($hmac);
		return bin2hex($hmac);
	}
}