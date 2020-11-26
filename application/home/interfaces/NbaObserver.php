<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/9/21
 * Time: 下午3:46
 */
namespace app\home\interfaces;
class NbaObserver extends ObserverAbstract
{
	protected $name;

	protected $secretary;

	public function __construct($name, $secretary)
	{
		$this->name = $name;
		$this->secretary = $secretary;
	}

	/**
	 * 收到通知后的具体操作
	 * @param $content
	 */
	public function update($content)
	{
		// TODO: Implement update() method.
		dump($this->name.$content.'不要再玩了，继续工作！');
	}
}