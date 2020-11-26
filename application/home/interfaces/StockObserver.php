<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/9/21
 * Time: 下午3:49
 */
namespace app\home\interfaces;
class StockObserver extends ObserverAbstract
{
	protected $name;

	protected $secretary;

	public function __construct($name, $secretary)
	{
		$this->name = $name;
		$this->secretary = $secretary;
	}

	public function update($content)
	{
		// TODO: Implement update() method.
		dump($this->name.$content.'不要在看股票，继续工作！');
	}
}