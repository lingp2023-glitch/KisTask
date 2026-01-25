<?php 
//应用名称/密钥
define('APP_NAME', "KisTask");
define('APPKEY', '2x6wie2fw12vgaq6');
define('APPSECERT', 'o3a9pnp1jz1xje30vc2y6osur7770cf1');

//应用配置
define('DOMAIN','http://192.168.3.105:8082/');
define('DOCUMENT_ROOT', "C:/Visual-NMP-x64/www/kistask/");

//客户端token过期时间 7200
define('TOKEN_EXPIRESIN', 7200); 

/*********************************************************
//业务参数
*********************************************************/
//严重程度
$config["severity"] = [0=>"致命", 1=>"严重", 2=>"一般", 3=>"提示", 4=>"建议"];
//优先级
$config["priority"] = [0=>"High", 1=>"Middle", 2=>"Low", 3=>"NicetoHave"];