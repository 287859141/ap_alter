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

		'MODULE_ALLOW_LIST' => array('Index','Langfang'), //允许模块组,可增,以逗号为隔

		//'MODULE_DENY_LIST'=>array('public','static')//禁止访问模块

        'DEFAULT_MODULE' => 'Index', //默认模块Home	

       // 'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称

        //'DEFAULT_ACTION'        =>  'index', // 默认操作名称

		//'MULTI_MODULE' =>  false,

		'URL_CASE_INSENSITIVE'=>'true',//链接大小写		

		'TMPL_EXCEPTION_FILE'=>'404:index', // 定义公共错误模板

		

		//'TMPL_EXCEPTION_FILE'=>'./Public/404/index.html',// 异常页面的模板文件



		//'DEFAULT_CHARSET' => 'GB2312',



		/* URL设置 */



	    'URL_MODEL' =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：



        // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式



		'SESSION_AUTO_START' => true,//开启session模式		



		'HTML_CACHE_ON'=>false, // 开启静态缓存



		//'URL_HTML_SUFFIX' =>'.html',  //URL伪静态后缀设置



		//'HTML_FILE_SUFFIX'  =>  '.shtml', // 设置静态缓存后缀为.shtml

		



		//'LAYOUT_ON'=>'true',//全局配置方式



		'LAYOUT_NAME'=>'Index',		



		'APP_SUB_DOMAIN_DEPLOY'   =>    true, // 开启子域名配置



		'APP_SUB_DOMAIN_RULES'    =>    array(   



		'lccb.jinbaolian.com'  => 'Langfang',  // admin.domain1.com域名指向Admin模块



			//'test.domain2.com'   => 'Test',  // test.domain2.com域名指向Test模块



        ),





		// 定义数据库连接信息



		'DB_TYPE'=> 'mysql',// 指定数据库是mysql



		'DB_HOST'=> 'localhost',



		'DB_NAME'=>'voucher', // 数据库名



		'DB_USER'=>'root',



		'DB_PWD'=>'root', //您的数据库连接密码



		'DB_PORT'=>'3306',



		'DB_CHARSET'=> 'utf8', // 字符集



		'DB_PREFIX'=>'v_',//数据表前缀



		'DB_DEBUG'  =>  'FLASE', // 数据库调试模式



		//'DB_DSN' => 'mysql://root:pw2020@localhost:3306/momo#utf8'



		'USER_AUTH_KEY'=>'authId',		



		//'DEFAULT_C_LAYER'=>'Action'//Action的配置



		/* 模板相关配置 */



		'TMPL_PARSE_STRING' => array(



		        '__STATIC__' => __ROOT__ . '/Public/static',



				'__PUBLIC__'=>__ROOT__.'/Public',

				

				'__404__'     => '/Public/404/', // 增加新的404路径替换规则



		),

		



);