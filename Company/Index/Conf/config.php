<?php
// +----------------------------------------------------------------------------
// | 描述：系统相关配置
// +----------------------------------------------------------------------------
// | 作者：吾道 176282102@qq.com
// +----------------------------------------------------------------------------
// | 版权：Copyright (c) 2015 www.jinbaolian.com All rights reserved.
// +----------------------------------------------------------------------------
// | 日期：2016-2-1
// +----------------------------------------------------------------------------
return array(
	//'配置项'=>'配置值'	
		//'SHOW_PAGE_TRACE' =>true,  // 开启页面调试工具		
		'URL_CASE_INSENSITIVE'=>'true',//链接大小写		
		/* URL设置 */
	    'URL_MODEL' =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
        // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
		'SESSION_AUTO_START' => true,//开启session模式
		'HTML_CACHE_ON'=>false, // 开启静态缓存
		//'URL_HTML_SUFFIX' =>'.html',  //URL伪静态后缀设置		
		'LAYOUT_ON'=>false,
		'LAYOUT_NAME'=>'Index',			
		//'DEFAULT_C_LAYER'=>'Action'//Action的配置
		/* 模板相关配置 */
		'TMPL_PARSE_STRING' => array(
		        '__STATIC__' => __ROOT__ . '/Public/static',
				'__PUBLIC__'=>__ROOT__.'/Public',
		),
		
);