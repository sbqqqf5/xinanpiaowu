<?php
//新浪 IP 地址接口
define('IPLOOKUP_SINA','http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js');
define('WECAHT_MCHID', '1311760801'); // 微信商户号
define('WECHAT_APPID', 'wxb1e9450e1805e8f1'); // 公众号 AppID
define('WECHAT_APPSECRET', '1c53d89344e50016b0ba236948c47a6d'); // 公众号 AppSecret

define('PLATFORM_APPID', 'wx5283dc6f41a12021'); // 开放平台 AppID
define('PLATFORM_APPSECRET', 'ecd3c9e433b9628e9bfb727e3e8d5d87'); // 开放平台 AppSecret


define('APP_DEBUG',True);
define('BIND_MODULE','Admin');
// 定义应用目录
define('APP_PATH','./Web/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';