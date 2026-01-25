<?php
//设置系统环境
define('GLOBAL_DEBUG',1);
@date_default_timezone_set('PRC');
@set_time_limit(1200);//20min pathInfoMuti,search,upload,download...
@ini_set("max_execution_time",1200);
@ini_set('session.cache_expire',1800);

if(GLOBAL_DEBUG){
	@ini_set("display_errors","on");
	@error_reporting(E_ERROR|E_PARSE|E_WARNING);//E_ALL
}
else
{
	@ini_set("display_errors","off");//on off
}

//常量定义
define('BASIC_PATH',str_replace('\\','/',dirname(dirname(__FILE__))).'/');
define('TEMPLATE',      BASIC_PATH .'template/');   //模版文件路径
define('CONTROLLER_DIR',BASIC_PATH .'controller/'); //控制器目录
define('MODEL_DIR',     BASIC_PATH .'model/');      //模型目录
define('LIB_DIR',       BASIC_PATH .'lib/');        //库目录
define('PLUGIN_DIR',    LIB_DIR .'plugins/');       //插件目录
define('FUNCTION_DIR',	LIB_DIR .'function/');		//函数库目录
define('CLASS_DIR',		LIB_DIR .'class/');			//内目录
define('CORER_DIR',		LIB_DIR .'core/');			//核心目录
define('DATA_PATH',     BASIC_PATH .'data/');       //用户数据目录
define('TEMP_PATH',     DATA_PATH .'temp/');        //临时目录
define('LOG_PATH',      BASIC_PATH .'log/');         //日志
define('CPS_SESSION',   DATA_PATH .'session/');     //session目录
//define('SESSION_ID','KIS_SESSION_ID_'.substr(md5(BASIC_PATH),0,5));
define('DEFAULT_PERRMISSIONS',0755);	//新建文件、解压文件默认权限，777 部分虚拟主机限制了777

define('UPLOAD_DIR','upload/');//资源上传目录
define('MAX_STORE_SIZE', 1024);
define('MAX_UPLOAD_SIZE', 1024*1024*6);//上传文件最大限制
define('UPLOAD_MAX_IMAG',1*1024*1024);//图片上传大小最大值
define('UPLOAD_MAX_AUDIO',30*1024*1024);//音频上传大小最大值
define('UPLOAD_MAX_VIDEO',30*1024*1024);//视频上传大小最大值
define('RES_TYPE_IMG', 0);
define('RES_TYPE_AUDIO', 1);
define('RES_TYPE_VIDEO', 2);
define('RES_TYPE_FILE', 3);
define('RES_TYPE_DOC', 4);

//数据库相关配置
include('config/config_db.php');
//业务相关配置
include('config/config_biz.php');

//包含执行文件
include(FUNCTION_DIR.'common.function.php');
include(FUNCTION_DIR.'file.function.php');
include(FUNCTION_DIR.'web.function.php');
include(FUNCTION_DIR.'util.function.php');
include(FUNCTION_DIR.'db.function.php');
include(CORER_DIR.'base.model.php');
include(CORER_DIR.'basetable.model.php');
include(CORER_DIR.'Application.class.php');
include(CORER_DIR.'Controller.class.php');

//工程session前缀
define('PREFIX_SESSION', 'kis_');
//redis数据前缀
define('PREFIX_REDIS', 'kis_');

//运行变量设置
$config['app_startTime'] = mtime();
//$config['autorun'] = array( array('controller'=>'app','function'=>'index'));
$config['autorun'] = array();

//session 设置
//@session_name(SESSION_ID);
//@session_save_path(CPS_SESSION);//session path
@session_start();
//@session_write_close();//避免session锁定问题;之后要修改$_SESSION 需要先调用session_start()

//初始化
init_config();
init_common();
