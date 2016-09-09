<?php
return array(
    'TMPL_ENGINE_TYPE' => 'PHP' ,

    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'fengniao_piaowu',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root3306',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'piaowu_',    // 数据库表前缀
    
    'URL_MODEL'        => 2,
    
    'ERROR_MESSAGE'         =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    // 'TMPL_EXCEPTION_FILE'   =>  './Public/tpl/error.php',   // 错误定向页面

    'TMPL_ACTION_ERROR'     =>  './Public/tpl/dispatch_jump.php', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   =>  './Public/tpl/dispatch_jump.php', // 默认成功跳转对应的模板文件
);