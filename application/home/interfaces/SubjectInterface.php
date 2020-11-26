<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/9/21
 * Time: 下午3:52
 */
namespace app\home\interfaces;
interface SubjectInterface
{
	public function attach($key, $observerAbstract);

	public function detach($key);

	public function notify();

	public function secretaryContent($content);
}