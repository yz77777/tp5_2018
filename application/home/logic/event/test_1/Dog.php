<?php
namespace app\home\logic\event\test_1;

/**
 * Class Dog
 * @package app\home\logic\event
 */
class Dog implements Observer
{

	public function watch()
	{
		echo 'Dog watch TV <hr />';
	}
}