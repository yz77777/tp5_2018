<?php
namespace app\home\logic\event\test_1;
/**
 * 被观察者
 * User: 大漠孤颜值
 * Date: 2020/12/14
 * Time: 下午4:26
 */
class Action implements Subject {
	protected $queue_observer = array();
	public function register(Observer $observer)
	{
		$this->queue_observer[]=$observer;
	}
	public function notify()
	{
		foreach ($this->queue_observer as $item) {
			$item->watch();
		}
	}
}