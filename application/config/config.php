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
    'deny_module_list'       => [],
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

	'LOAD_EXT_FILE' =>'common',

//	'exception_tmpl'         => APP_PATH . DS . 'error.tpl',
//	'exception_tmpl'         => THINK_PATH . '..' . DS . 'error.tpl',
//	'error_message'          => '哇，页面错误了！请稍后再试～',
	// 显示错误信息
	'show_error_msg'         => true,
	// 异常处理handle类 留空使用 \think\exception\Handle
	'exception_handle'       => 'app\common\exception\HandleBase',


	'template'               => [
		// 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写
		'auto_rule'    => 2,
	],

	// +----------------------------------------------------------------------
	// | URL设置
	// +----------------------------------------------------------------------

	// 是否开启路由
	'url_route_on'           => true,
	// 是否强制使用路由
	'url_route_must'         => false,

	// URL伪静态后缀
	'url_html_suffix'        => 'html',

	// URL普通方式参数 用于自动生成
	'url_common_param'       => false,
	// URL参数方式 0 按名称成对解析 1 按顺序解析
	'url_param_type'         => 0,




];
