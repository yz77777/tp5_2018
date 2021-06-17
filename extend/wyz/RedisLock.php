<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/6/16
 * Time: 下午5:09
 */
namespace wyz;
use think\cache\driver\Redis;
class RedisLock extends Redis{
	protected $redisHandler;

	public function __construct($options = [])
	{
		parent::__construct($options);
		$redis = new Redis();
		$this->redisHandler = $redis;
	}

	public function lock($key, $expire, $sleepMillis) {

		$result = $this->redisHandler->handler()->set($key, true, ['nx', 'ex'=>$expire]);

		for ($startTime = time(); !$result && time() - $startTime < $expire; $result = $this->redisHandler->handler()->set($key, true, ['nx', 'ex'=>$expire])) {

			try {
				sleep($sleepMillis);
			} catch (\Exception $e) {
				return false;
			}
		}
		return $result;
	}

	public function releaseLock($key) {
		$this->redisHandler->rm($key);
	}
}