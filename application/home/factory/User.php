<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2019/11/22
 * Time: 上午11:46
 */
namespace app\home\factory;
use UserProperties;
class User implements UserProperties {

	private $userName;
	private $gender;
	private $job;

	public function __construct($userName, $gender, $job)
	{
		$this->userName = $userName;
		$this->gender = $gender;
		$this->job = $job;
	}

	public function getUserName() {
		return $this->userName;
	}

	public function getGender()
	{
		// TODO: Implement getGender() method.
		return $this->gender;
	}

	public function getJob()
	{
		// TODO: Implement getJob() method.
		return $this->job;
	}
}