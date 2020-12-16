<?php
namespace app\home\logic\event\test_1;


class Cat implements Observer
{
	public function watch()
	{
		echo 'Cat watch TV <hr/>';
	}
}