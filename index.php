<?php
// +----------------------------------------------------------------------
// | kernel:ThinkPHP 
// +----------------------------------------------------------------------
// | Copyright (c) 2005-2016 http://jinbaolian.com All rights reserved.
// +----------------------------------------------------------------------
// | Create project Date 2015-10-01 
// +----------------------------------------------------------------------
// | Recommended configuration Linux Nginx Mysql Php5.3
// +----------------------------------------------------------------------
// | Person in charge: 吾道 176282102@qq.com>
// +----------------------------------------------------------------------
// 应用入口文件
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
// 开启调试模?#65533; 建议开发阶段开?#65533; 部署阶段注释或者设为false
define('APP_DEBUG',true);
//$_GET['m'] = 'Admin';
// 定义应用目录
define('APP_PATH','./Company/');
//define('BUILD_LITE_FILE',true);//生成lite文件
//define('APP_NAME','Vocher');
//define('Admin_URL_JS','/shop/Public/Admin/js');
include '../global_variable/LANG_GROUPS.php';
include '../global_variable/LANG_PRODUCT_STATUS.php';
include '../global_variable/LANG_COMPANIES.php';
$perArray=include '../global_variable/LANG_ROLES.php';
$arrpageurl=explode('/',$_SERVER['PHP_SELF']);

//echo $_SERVER['PHP_SELF'];	

$LandnowCom=$LangStatus['COMPANIES'][$arrpageurl[3]];

echo $arrpageurl[3];
// 引入ThinkPHP入口文件

require './TP/TP.php';
// 亲^_^ 后面不需要任何代码了 就是如此简?#65533;