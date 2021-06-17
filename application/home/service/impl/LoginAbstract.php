<?php
/**
 * Created by PhpStorm.
 * User: 大漠孤颜值
 * Date: 2021/6/17
 * Time: 上午10:50
 */
namespace app\home\service\impl;
abstract class LoginAbstract {

	abstract public function login($loginAccount, $password);
}