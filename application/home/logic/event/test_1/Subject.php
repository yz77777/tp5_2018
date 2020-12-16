<?php
namespace app\home\logic\event\test_1;

/**
 * 主题接口
 * Interface Subject
 */
interface Subject {
	public function register(Observer $observer);

	public function notify();
}