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
    'app_trace'              => true,


    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

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
    // 自动搜索控制器
    'controller_auto_search' => false,


	// 异常处理handle类 留空使用 \think\exception\Handle
	'exception_handle'       => '\app\common\exception\JsonException',
	// 异常页面的模板文件
	'exception_tmpl'         => APP_PATH .'home'. DS .'view'. DS .'public'. DS .'exception.tpl',
	// 错误显示信息,非调试模式有效
	'error_message'          => '页面错误！请稍后再试～',
	// 显示错误信息
	'show_error_msg'         => false,
	// 是否记录trace信息到日志
	'record_trace'           => false,

	// +----------------------------------------------------------------------
	// | url设置
	// +----------------------------------------------------------------------

	// URL伪静态后缀
	'url_html_suffix'        => 'html',
	// 是否开启路由
//	'url_route_on'           => false,

];
