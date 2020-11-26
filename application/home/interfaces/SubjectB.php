<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2020/9/21
 * Time: 下午3:56
 */
namespace app\home\interfaces;
class SubjectB implements SubjectInterface
{
	private $list = [];

	private $content;

	public function attach($key, $observerAbstract)
	{
		// TODO: Implement attach() method.
		$this->list[$key] = $observerAbstract;
	}

	public function detach($key)
	{
		// TODO: Implement detach() method.
		unset($this->list[$key]);
	}

	public function notify()
	{
		// TODO: Implement notify() method.
		foreach ($this->list as $value) {
			$value->update($this->content);
		}
	}

	public function secretaryContent($content)
	{
		// TODO: Implement secretaryContent() method.
		$this->content = $content;
	}
}