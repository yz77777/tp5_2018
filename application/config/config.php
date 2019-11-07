<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => false,


    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

	// 是否支持多模块
	'app_multi_module'       => true,
    // 默认模块名
    'default_module'         => 'home',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
	// 应用类库后缀
	'class_suffix'           => true,
    // 自动搜索控制器
    'controller_auto_search' => false,

//	'exception_tmpl'         => APP_PATH . DS . 'error.tpl',
//	'exception_tmpl'         => THINK_PATH . '..' . DS . 'error.tpl',
//	'error_message'          => '哇，页面错误了！请稍后再试～',


	'template'               => [
		// 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
		'auto_rule'    => 2,
	],






];
