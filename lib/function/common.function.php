<?php
/**
 * 加载类，从class目录；controller；model目录中寻找class
 */
function _autoload($className){
	if (file_exists(CLASS_DIR . strtolower($className) . '.class.php')) {
		include(CLASS_DIR . strtolower($className) . '.class.php');
	} else if (file_exists(CONTROLLER_DIR . strtolower($className) . '.class.php')) {
		include(CONTROLLER_DIR . strtolower($className) . '.class.php');
	} else if (file_exists(MODEl_DIR . strtolower($className) . '.class.php')) {
		include(MODEl_DIR . strtolower($className) . '.class.php');
	} else {
		show_tips($className.' is not exist');
	} 
}

/**
 * 生产model对象
 */
function init_model($model_name){ 
	if (!class_exists($model_name.'Model')) {
		$model_file = MODEL_DIR.$model_name.'.model.php'; 
		if(!is_file($model_file)){
			return false;
		} 
		include($model_file); 
	}
	$reflectionObj = new ReflectionClass($model_name.'Model');
	$args = func_get_args();
	array_shift($args);
	return $reflectionObj -> newInstanceArgs($args);
}

/**
 * 生产子model对象
 */
function init_submodel($model_name, $sub_name){ 
	if (!class_exists($model_name.'Model')) {
		$model_file = MODEL_DIR.$sub_name."/".$model_name.'.model.php';  
		if(!is_file($model_file)){
			return false;
		}  
		//include($model_file); 
		require_once($model_file); 
	}
	$reflectionObj = new ReflectionClass($model_name.'Model');
	$args = func_get_args();
	array_shift($args);
	return $reflectionObj -> newInstanceArgs($args);
}

/**
 * 生产controller对象
 */
function init_controller($controller_name){
	if (!class_exists($controller_name)) {
		$model_file = CONTROLLER_DIR.$controller_name.'.class.php';
		if(!is_file($model_file)){
			return false;
		}
		include($model_file);
	}
	$reflectionObj = new ReflectionClass($controller_name);
	$args = func_get_args();
	array_shift($args);
	return $reflectionObj -> newInstanceArgs($args);
}

/**
 * 加载类
 */
function load_class($class){
	$filename = CLASS_DIR.$class.'.class.php';
	if (file_exists($filename)) {
		include($filename);
	}else{
		show_tips($filename.' is not exist');
	}
}
/**
 * 加载函数库
 */
function load_function($function){
	$filename = FUNCTION_DIR.$function.'.function.php';
	if (file_exists($filename)) {
		include($filename);
	}else{
		show_tips($filename.' is not exist');
	}
}
/**
 * 文本字符串转换
 */
function mystr($str){
	$from = array("\r\n", " ");
	$to = array("<br/>", "&nbsp");
	return str_replace($from, $to, $str);
} 

// 清除多余空格和回车字符
function strip($str){
	return preg_replace('!\s+!', '', $str);
} 

/**
 *
 */
function showtime()
{
	return date("Y-m-d H:i:s");
}

/**
 * 获取精确时间
 */
function mtime(){
	$t= explode(' ',microtime());
	$time = $t[0]+$t[1];
	return $time;
}


//获取时间到毫秒
function msectime() {
    list($msec, $sec) = explode(' ', microtime());
    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}

/**
 * 求两个日期之间相差的天数
 * (针对1970年1月1日之后，求之前可以采用泰勒公式)
 * @param string $day1
 * @param string $day2
 * @return number
 */
function diffBetweenTwoDays ($day1, $day2)
{
  $second1 = strtotime($day1);
  $second2 = strtotime($day2);
    
  if ($second1 < $second2) {
    $tmp = $second2;
    $second2 = $second1;
    $second1 = $tmp;
  }
  return ($second1 - $second2) / 86400;
}

/**
 * 过滤HTML
 */
function clear_html($HTML, $br = true){
	$HTML = htmlspecialchars(trim($HTML));
	$HTML = str_replace("\t", ' ', $HTML);
	if ($br) {
		return nl2br($HTML);
	} else {
		return str_replace("\n", '', $HTML);
	} 
}

/**
 * 过滤js、css等 
 */
function filter_html($html){
	$find = array(
		"/<(\/?)(script|i?frame|style|html|body|title|link|meta|\?|\%)([^>]*?)>/isU",
		"/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
		"/javascript\s*:/isU",
	);
	$replace = array("＜\\1\\2\\3＞","\\1\\2","");
	return preg_replace($find,$replace,$html);
}

/**
 * 将obj深度转化成array
 * 
 * @param  $obj 要转换的数据 可能是数组 也可能是个对象 还可能是一般数据类型
 * @return array || 一般数据类型
 */
function obj2array($obj){
	if (is_array($obj)) {
		foreach($obj as &$value) {
			$value = obj2array($value);
		} 
		return $obj;
	} elseif (is_object($obj)) {
		$obj = get_object_vars($obj);
		return obj2array($obj);
	} else {
		return $obj;
	} 
}

function ignore_timeout(){
	@ignore_user_abort(true);
	@set_time_limit(24 * 60 * 60);//set_time_limit(0)  1day
	@ini_set('memory_limit', '2028M');//2G;
}

/**
 * 计算时间差
 * 
 * @param char $pretime 
 * @return char 
 */
function spend_time(&$pretime){
	$now = microtime(1);
	$spend = round($now - $pretime, 5);
	$pretime = $now;
	return $spend;
} 

function check_code($code){
	ob_clean();
	header("Content-type: image/png");
	$width = 70;$height=27;
	$fontsize = 18;$len = strlen($code);
	$im = @imagecreatetruecolor($width, $height) or die("create image error!");
	$background_color = imagecolorallocate($im,255, 255, 255);
	imagefill($im, 0, 0, $background_color);  
	for ($i = 0; $i < 2000; $i++) {//获取随机淡色            
		$line_color = imagecolorallocate($im, mt_rand(180,255),mt_rand(160, 255),mt_rand(100, 255));
		imageline($im,mt_rand(0,$width),mt_rand(0,$height), //画直线
			mt_rand(0,$width), mt_rand(0,$height),$line_color);
		imagearc($im,mt_rand(0,$width),mt_rand(0,$height), //画弧线
			mt_rand(0,$width), mt_rand(0,$height), $height, $width,$line_color);
	}
	$border_color = imagecolorallocate($im, 160, 160, 160);   
	imagerectangle($im, 0, 0, $width-1, $height-1, $border_color);//画矩形，边框颜色200,200,200
	for ($i = 0; $i < $len; $i++) {//写入随机字串
		$text_color = imagecolorallocate($im,mt_rand(30, 140),mt_rand(30,140),mt_rand(30,140));
		imagechar($im,10,$i*$fontsize+6,rand(1,$height/3),$code[$i],$text_color);
	}
	imagejpeg($im);//显示图
	imagedestroy($im);//销毁图片
}

/**
 * 返回当前浮点式的时间,单位秒;主要用在调试程序程序时间时用
 * 
 * @return float 
 */
function microtime_float(){
	list($usec, $sec) = explode(' ', microtime());
	return ((float)$usec + (float)$sec);
}
/**
 * 计算N次方根
 * @param  $num 
 * @param  $root 
 */
function croot($num, $root = 3){
	$root = intval($root);
	if (!$root) {
		return $num;
	} 
	return exp(log($num) / $root);
} 

function add_magic_quotes($array){
	foreach ((array) $array as $k => $v) {
		if (is_array($v)) {
			$array[$k] = add_magic_quotes($v);
		} else {
			$array[$k] = addslashes($v);
		} 
	} 
	return $array;
} 
// 字符串加转义
function add_slashes($string){
	if (!isset($GLOBALS['magic_quotes_gpc']) || !$GLOBALS['magic_quotes_gpc']) {
		if (is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = add_slashes($val);
			} 
		} else {
			$string = addslashes($string);
		} 
	} 
	return $string;
} 

/**
 * hex to binary
 */
if (!function_exists('hex2bin')) {
	function hex2bin($hexdata)	{
		return pack('H*', $hexdata);
	}
}

if (!function_exists('gzdecode')) {
	function gzdecode($data){
		return gzinflate(substr($data,10,-8));
	}
}

/**
 * 二维数组按照指定的键值进行排序，
 * 
 * @param  $keys 根据键值
 * @param  $type 升序降序
 * @return array $array = array(
 * array('name'=>'手机','brand'=>'诺基亚','price'=>1050),
 * array('name'=>'手表','brand'=>'卡西欧','price'=>960)
 * );$out = array_sort($array,'price');
 */
function array_sort($arr, $keys, $type = 'asc'){
	$keysvalue = $new_array = array();
	foreach ($arr as $k => $v) {
		$keysvalue[$k] = $v[$keys];
	} 
	if ($type == 'asc') {
		asort($keysvalue);
	} else {
		arsort($keysvalue);
	} 
	reset($keysvalue);
	foreach ($keysvalue as $k => $v) {
		$new_array[$k] = $arr[$k];
	} 
	return $new_array;
} 
/**
 * 遍历数组，对每个元素调用 $callback，假如返回值不为假值，则直接返回该返回值；
 * 假如每次 $callback 都返回假值，最终返回 false
 * 
 * @param  $array 
 * @param  $callback 
 * @return mixed 
 */
function array_try($array, $callback){
	if (!$array || !$callback) {
		return false;
	} 
	$args = func_get_args();
	array_shift($args);
	array_shift($args);
	if (!$args) {
		$args = array();
	} 
	foreach($array as $v) {
		$params = $args;
		array_unshift($params, $v);
		$x = call_user_func_array($callback, $params);
		if ($x) {
			return $x;
		} 
	} 
	return false;
} 
// 求多个数组的并集
function array_union(){
	$argsCount = func_num_args();
	if ($argsCount < 2) {
		return false;
	} else if (2 === $argsCount) {
		list($arr1, $arr2) = func_get_args();

		while ((list($k, $v) = each($arr2))) {
			if (!in_array($v, $arr1)) $arr1[] = $v;
		} 
		return $arr1;
	} else { // 三个以上的数组合并
		$arg_list = func_get_args();
		$all = call_user_func_array('array_union', $arg_list);
		return array_union($arg_list[0], $all);
	} 
}
// 取出数组中第n项
function array_get_index($arr,$index){
   foreach($arr as $k=>$v){
	   $index--;
	   if($index<0) return array($k,$v);
   }
}

//set_error_handler('errorHandler',E_ERROR|E_PARSE|E_CORE_ERROR|E_COMPILE_ERROR|E_USER_ERROR);
register_shutdown_function('fatalErrorHandler');
function errorHandler($err_type,$errstr,$errfile,$errline){
	if (($err_type & E_WARNING) === 0 && ($err_type & E_NOTICE) === 0) {
		return false;
	}
	$arr = array(
		$err_type,
		$errstr,
		//" in [".$errfile.']',
		" in [".get_path_this(get_path_father($errfile)).'/'.get_path_this($errfile).']',
		'line:'.$errline,
	);
	$str = implode("  ",$arr)."<br/>";
	show_tips($str);
}

//捕获fatalError
function fatalErrorHandler(){
	$e = error_get_last();
	if(!$e) return;
	
	switch($e['type']){
		case E_ERROR:
		case E_PARSE:
		case E_CORE_ERROR:
		case E_COMPILE_ERROR:
		case E_USER_ERROR:
			errorHandler($e['type'],$e['message'],$e['file'],$e['line']);
			break;
		case E_NOTICE:break;
		default:break;
	}
}

function show_tips($message,$url= '', $time = 3){
	ob_get_clean();
	header('Content-Type: text/html; charset=utf-8');
	$goto = "content='$time;url=$url'";
	$info = "Auto jump after {$time}s, <a href='$url'>Click Here</a>";
	if ($url == "") {
		$goto = "";
		$info = "";
	} //是否自动跳转
	$message = filter_html(nl2br($message));
	echo<<<END
<html>
	<meta http-equiv='refresh' $goto charset="utf-8">
	<style>
	#msgbox{border: 1px solid #ddd;border: 1px solid #eee;padding: 20px 40px 40px 40px;border-radius: 5px;background: #f6f6f6;
	font-family: 'Helvetica Neue', "Microsoft Yahei", "微软雅黑", "STXihei", "WenQuanYi Micro Hei", sans-serif;
	color:888;margin:0 auto;margin-top:10%;width:400px;font-size:14px;color:#666;word-wrap: break-word;word-break: break-all;}
	#msgbox #info{margin-top: 10px;color:#aaa;font-size: 12px;}
	#msgbox #title{color: #888;border-bottom: 1px solid #ddd;padding: 10px 0;margin: 0 0 15px;font-size:18px;}
	#msgbox #info a{color: #64b8fb;text-decoration: none;padding: 2px 0px;border-bottom: 1px solid;}
	#msgbox a{text-decoration:none;color:#2196F3;}#msgbox a:hover{color:#f60;border-bottom:1px solid}
	</style>
	<body>
	<div id="msgbox">
		<div id="title">Warning!</div>
		<div id="message">$message</div>
		<div id="info">$info</div>
	</div>
	</body>
</html>
END;
	exit;
}
function get_caller_info() {
	$trace = debug_backtrace();
	foreach($trace as $i=>$call){
		if (isset($call['object']) && is_object($call['object'])) { 
			$call['object'] = "  ".get_class($call['object']); 
		}
		if (is_array($call['args'])) {
			foreach ($call['args'] AS &$arg) {
				if (is_object($arg)) {
					$arg = "  ".get_class($arg);
				}
			}
		}
		$trace_text[$i] = "#".$i." ".basename($call['file']).'【'.$call['line'].'】 ';
		$trace_text[$i].= (!empty($call['object'])?$call['object'].$call['type']:'');
		if($call['function']=='show_json'){
			$trace_text[$i].= $call['function'].'(args)';
		}else{
			$trace_text[$i].= $call['function'].'('.json_encode($call['args'],true).')';
		}		
	}
	unset($trace_text[0]);
	$trace_text = array_reverse($trace_text);
	return $trace_text;
}

/**
 * 打包返回AJAX请求的数据
 * @params {int} 返回状态码， 通常0表示正常
 * @params {array} 返回的数据集合
 */
function show_json($data,$code = true,$info=''){
	$use_time = mtime() - $GLOBALS['config']['app_startTime'];
	$result = array('code'=>$code,'use_time'=>$use_time,'data'=>$data);
	if(defined("GLOBAL_DEBUG") && GLOBAL_DEBUG==1){
		$result['call'] = get_caller_info();
	}
	if ($info != '') {
		$result['info'] = $info;
	}
	ob_end_clean();
	header("X-Powered-By: kodExplorer.");
	header('Content-Type: application/json; charset=utf-8');
	$json = json_encode($result);
	if($json === false){
	    $json = __json_encode($result);
	}
	echo $json;
	exit;
}

function __json_encode( $data ) {            
    if( is_array($data) || is_object($data) ) { 
        $islist = is_array($data) && ( empty($data) || array_keys($data) === range(0,count($data)-1) ); 
        
        if( $islist ) { 
            $json = '[' . implode(',', array_map('__json_encode', $data) ) . ']'; 
        } else { 
            $items = Array(); 
            foreach( $data as $key => $value ) { 
                $items[] = __json_encode("$key") . ':' . __json_encode($value); 
            } 
            $json = '{' . implode(',', $items) . '}'; 
        } 
    } else if( is_string($data) ) { 
        $string = '"' . addcslashes($data, "\\\"\n\r\t/" . chr(8) . chr(12)) . '"'; 
        $json    = ''; 
        $len    = strlen($string); 
        # Convert UTF-8 to Hexadecimal Codepoints. 
        for( $i = 0; $i < $len; $i++ ) { 
            $char = $string[$i]; 
            $c1 = ord($char); 
            
            # Single byte; 
            if( $c1 <128 ) { 
                $json .= ($c1 > 31) ? $char : sprintf("\\u%04x", $c1); 
                continue; 
            } 
            
            # Double byte 
            $c2 = ord($string[++$i]); 
            if ( ($c1 & 32) === 0 ) { 
                $json .= sprintf("\\u%04x", ($c1 - 192) * 64 + $c2 - 128); 
                continue; 
            } 
            
            # Triple 
            $c3 = ord($string[++$i]); 
            if( ($c1 & 16) === 0 ) { 
                $json .= sprintf("\\u%04x", (($c1 - 224) <<12) + (($c2 - 128) << 6) + ($c3 - 128)); 
                continue; 
            } 
                
            # Quadruple 
            $c4 = ord($string[++$i]); 
            if( ($c1 & 8 ) === 0 ) { 
                $u = (($c1 & 15) << 2) + (($c2>>4) & 3) - 1;
                $w1 = (54<<10) + ($u<<6) + (($c2 & 15) << 2) + (($c3>>4) & 3); 
                $w2 = (55<<10) + (($c3 & 15)<<6) + ($c4-128); 
                $json .= sprintf("\\u%04x\\u%04x", $w1, $w2); 
            } 
        } 
    } else { 
        $json = strtolower(var_export( $data, true )); 
    } 
    return $json; 
}

/**
 * 简单模版转换，用于根据配置获取列表：
 * 参数：cute1:第一次切割的字符串，cute2第二次切割的字符串,
 * arraylist为待处理的字符串，$current 为标记当前项，$current_str为当项标记的替换。
 * $tpl为处理后填充到静态模版({0}代表切割后左值,{1}代表切割后右值,{this}代表当前项填充值)
 * 例子：
 * $arr="default=淡蓝(默认)=5|mac=mac海洋=6|mac1=mac1海洋=7";
 * $tpl="<li class='list {this}' theme='{0}'>{1}_{2}</li>\n";
 * echo getTplList('|','=',$arr,$tpl,'mac'),'<br/>';
 */
function getTplList($cute1, $cute2, $arraylist, $tpl,$current,$current_str=''){
	$list = explode($cute1, $arraylist);
	if ($current_str == '') $current_str ="this";
	$html = '';
	foreach ($list as $value) {
		$info = explode($cute2, $value);
		$arr_replace = array();	
		foreach ($info as $key => $value) {
			$arr_replace[$key]='{'.$key .'}';
		}
		if ($info[0] == $current) {
			$temp = str_replace($arr_replace, $info, $tpl);
			$temp = str_replace('{this}', $current_str, $temp);
		} else {
			$temp = str_replace($arr_replace, $info, $tpl);
			$temp = str_replace('{this}', '', $temp);
		}
		$html .= $temp;
	} 
	return $html;
}

/**
 * 去掉HTML代码中的HTML标签，返回纯文本
 * @param string $document 待处理的字符串
 * @return string 
 */
function html2txt($document){
	$search = array ("'<script[^>]*?>.*?</script>'si", // 去掉 javascript
		"'<[\/\!]*?[^<>]*?>'si", // 去掉 HTML 标记
		"'([\r\n])[\s]+'", // 去掉空白字符
		"'&(quot|#34);'i", // 替换 HTML 实体
		"'&(amp|#38);'i",
		"'&(lt|#60);'i",
		"'&(gt|#62);'i",
		"'&(nbsp|#160);'i",
		"'&(iexcl|#161);'i",
		"'&(cent|#162);'i",
		"'&(pound|#163);'i",
		"'&(copy|#169);'i",
		"'&#(\d+);'e"); // 作为 PHP 代码运行
	$replace = array ("",
		"",
		"",
		"\"",
		"&",
		"<",
		">",
		" ",
		chr(161),
		chr(162),
		chr(163),
		chr(169),
		"chr(\\1)");
	$text = preg_replace ($search, $replace, $document);
	return $text;
}

// 获取内容第一条
function matchs($content, $preg){
	$preg = "/" . $preg . "/isU";
	$result = [];
	preg_match($preg, $content, $result);
	return $result[1];
}
// 获取内容,获取一个页面若干信息.结果在 1,2,3……中
function matchs_all($content, $preg){
	$preg = "/" . $preg . "/isU";
	$result = "";
	preg_match_all($preg, $content, $result);
	return $result;
}

/**
 * 获取指定长度的 utf8 字符串
 * 
 * @param string $string 
 * @param int $length 
 * @param string $dot 
 * @return string 
 */
function get_utf8_str($string, $length, $dot = '...'){
	if (strlen($string) <= $length) return $string;

	$strcut = '';
	$n = $tn = $noc = 0;

	while ($n < strlen($string)) {
		$t = ord($string[$n]);
		if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
			$tn = 1;
			$n++;
			$noc++;
		} elseif (194 <= $t && $t <= 223) {
			$tn = 2;
			$n += 2;
			$noc += 2;
		} elseif (224 <= $t && $t <= 239) {
			$tn = 3;
			$n += 3;
			$noc += 2;
		} elseif (240 <= $t && $t <= 247) {
			$tn = 4;
			$n += 4;
			$noc += 2;
		} elseif (248 <= $t && $t <= 251) {
			$tn = 5;
			$n += 5;
			$noc += 2;
		} elseif ($t == 252 || $t == 253) {
			$tn = 6;
			$n += 6;
			$noc += 2;
		} else {
			$n++;
		} 
		if ($noc >= $length) break;
	} 
	if ($noc > $length) {
		$n -= $tn;
	} 
	if ($n < strlen($string)) {
		$strcut = substr($string, 0, $n);
		return $strcut . $dot;
	} else {
		return $string ;
	} 
} 

/**
 * 字符串截取，支持中文和其他编码
 * 
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string 
 */
function msubstr($str, $start = 0, $length=0, $charset = "utf-8", $suffix = true){
	if (function_exists("mb_substr")) {
		$i_str_len = mb_strlen($str);
		$s_sub_str = mb_substr($str, $start, $length, $charset);
		if ($length >= $i_str_len) {
			return $s_sub_str;
		} 
		return $s_sub_str . '...';
	} elseif (function_exists('iconv_substr')) {
		return iconv_substr($str, $start, $length, $charset);
	} 
	$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("", array_slice($match[0], $start, $length));
	if ($suffix) return $slice . "…";
	return $slice;
} 

function web2wap(&$content){
	$search = array ("/<img[^>]+src=\"([^\">]+)\"[^>]+>/siU",
		"/<a[^>]+href=\"([^\">]+)\"[^>]*>(.*)<\/a>/siU",
		"'<br[^>]*>'si",
		"'<p>'si",
		"'</p>'si",
		"'<script[^>]*?>.*?</script>'si", // 去掉 javascript
		"'<[\/\!]*?[^<>]*?>'si", // 去掉 HTML 标记
		"'([\r\n])[\s]+'", // 去掉空白字符
		); // 作为 PHP 代码运行
	$replace = array ("#img#\\1#/img#",
		"#link#\\1#\\2#/link#",
		"[br]",
		"",
		"[br]",
		"",
		"",
		"",
		);
	$text = preg_replace ($search, $replace, $content);
	$text = str_replace("[br]", "<br/>", $text);
	$img_start = "<img src=\"" . $publish_url . "automini.php?src=";
	$img_end = "&amp;pixel=100*80&amp;cache=1&amp;cacheTime=1000&amp;miniType=png\" />";
	$text = preg_replace ("/#img#(.*)#\/img#/isUe", "'$img_start'.urlencode('\\1').'$img_end'", $text);
	$text = preg_replace ("/#link#(.*)#(.*)#\/link#/isU", "<a href=\"\\1\">\\2</a>", $text);
	while (preg_match("/<br\/><br\/>/siU", $text)) {
		$text = str_replace('<br/><br/>', '<br/>', $text);
	} 
	return $text;
} 

/**
 * 获取变量的名字
 * eg hello="123" 获取ss字符串
 */
function get_var_name(&$aVar){
	foreach($GLOBALS as $key => $var) {
		if ($aVar == $GLOBALS[$key] && $key != "argc") {
			return $key;
		} 
	} 
} 
// -----------------变量调试-------------------
/**
 * 格式化输出变量，或者对象
 * 
 * @param mixed $var 
 * @param boolean $exit 
 */
function pr($var, $exit = false){
	ob_start();
	$style = '<style>
	pre#debug{margin:10px;font-size:14px;color:#222;font-family:Consolas ;line-height:1.2em;background:#f6f6f6;border-left:5px solid #444;padding:5px;width:95%;word-break:break-all;}
	pre#debug b{font-weight:400;}
	#debug #debug_str{color:#E75B22;}
	#debug #debug_keywords{font-weight:800;color:00f;}
	#debug #debug_tag1{color:#22f;}
	#debug #debug_tag2{color:#f33;font-weight:800;}
	#debug #debug_var{color:#33f;}
	#debug #debug_var_str{color:#f00;}
	#debug #debug_set{color:#0C9CAE;}</style>';
	if (is_array($var)) {
		print_r($var);
	} else if (is_object($var)) {
		echo get_class($var) . " Object";
	} else if (is_resource($var)) {
		echo (string)$var;
	} else {
		echo var_dump($var);
	} 
	$out = ob_get_clean(); //缓冲输出给$out 变量	
	$out = preg_replace('/"(.*)"/', '<b id="debug_var_str">"' . '\\1' . '"</b>', $out); //高亮字符串变量
	$out = preg_replace('/=\>(.*)/', '=>' . '<b id="debug_str">' . '\\1' . '</b>', $out); //高亮=>后面的值
	$out = preg_replace('/\[(.*)\]/', '<b id="debug_tag1">[</b><b id="debug_var">' . '\\1' . '</b><b id="debug_tag1">]</b>', $out); //高亮变量
	$from = array('    ', '(', ')', '=>');
	$to = array('  ', '<b id="debug_tag2">(</i>', '<b id="debug_tag2">)</b>', '<b id="debug_set">=></b>');
	$out = str_replace($from, $to, $out);

	$keywords = array('Array', 'int', 'string', 'class', 'object', 'null'); //关键字高亮
	$keywords_to = $keywords;
	foreach($keywords as $key => $val) {
		$keywords_to[$key] = '<b id="debug_keywords">' . $val . '</b>';
	} 
	$out = str_replace($keywords, $keywords_to, $out);
	$out = str_replace("\n\n", "\n", $out);
	echo $style . '<pre id="debug"><b id="debug_keywords">' . get_var_name($var) . '</b> = ' . $out . '</pre>';
	if ($exit) exit; //为真则退出
} 

/**
 * 调试输出变量，对象的值。
 * 参数任意个(任意类型的变量)
 * 
 * @return echo 
 */
function debug_out(){
	$avg_num = func_num_args();
	$avg_list = func_get_args();
	ob_start();
	for($i = 0; $i < $avg_num; $i++) {
		pr($avg_list[$i]);
	} 
	$out = ob_get_clean();
	echo $out;
	exit;
} 

/**
 * 取$from~$to范围内的随机数
 * 
 * @param  $from 下限
 * @param  $to 上限
 * @return unknown_type 
 */
function rand_from_to($from, $to){
	$size = $to - $from; //数值区间
	$max = 30000; //最大
	if ($size < $max) {
		return $from + mt_rand(0, $size);
	} else {
		if ($size % $max) {
			return $from + random_from_to(0, $size / $max) * $max + mt_rand(0, $size % $max);
		} else {
			return $from + random_from_to(0, $size / $max) * $max + mt_rand(0, $max);
		} 
	} 
} 

/**
 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
 * 
 * @param string $len 长度
 * @param string $type 字串类型：0 字母 1 数字 2 大写字母 3 小写字母  4 中文  
 * 其他为数字字母混合(去掉了 容易混淆的字符oOLl和数字01，)
 * @param string $addChars 额外字符
 * @return string 
 */
function rand_string($len = 4, $type='check_code'){
	$str = '';
	switch ($type) {
		case 1://数字
			$chars = str_repeat('0123456789', 3);
			break;
		case 2://大写字母
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
		case 3://小写字母
			$chars = 'abcdefghijklmnopqrstuvwxyz';
			break;
		case 4://大小写中英文
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
			break;
		default: 
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
			break;
	}
	if ($len > 10) { // 位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
	} 
	if ($type != 4) {
		$chars = str_shuffle($chars);
		$str = substr($chars, 0, $len);
	} else {
		// 中文随机字
		for($i = 0; $i < $len; $i ++) {
			$str .= msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8') - 1)), 1);
		} 
	} 
	return $str;
} 

/**
 * 生成自动密码
 */
function make_password(){
	$temp = '0123456789abcdefghijklmnopqrstuvwxyz'.
			'ABCDEFGHIJKMNPQRSTUVWXYZ~!@#$^*)_+}{}[]|":;,.'.time();
	for($i=0;$i<10;$i++){
		$temp = str_shuffle($temp.substr($temp,-5));
	}
	return md5($temp);
}


/**
 * php DES解密函数
 * 
 * @param string $key 密钥
 * @param string $encrypted 加密字符串
 * @return string 
 */
function des_decode($key, $encrypted){
	$encrypted = base64_decode($encrypted);
	$td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_CBC, ''); //使用MCRYPT_DES算法,cbc模式
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	$ks = mcrypt_enc_get_key_size($td);

	mcrypt_generic_init($td, $key, $key); //初始处理
	$decrypted = mdecrypt_generic($td, $encrypted); //解密
	
	mcrypt_generic_deinit($td); //结束
	mcrypt_module_close($td);
	return pkcs5_unpad($decrypted);
} 
/**
 * php DES加密函数
 * 
 * @param string $key 密钥
 * @param string $text 字符串
 * @return string 
 */
function des_encode($key, $text){
	$y = pkcs5_pad($text);
	$td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_CBC, ''); //使用MCRYPT_DES算法,cbc模式
	$ks = mcrypt_enc_get_key_size($td);

	mcrypt_generic_init($td, $key, $key); //初始处理
	$encrypted = mcrypt_generic($td, $y); //解密
	mcrypt_generic_deinit($td); //结束
	mcrypt_module_close($td);
	return base64_encode($encrypted);
} 
function pkcs5_unpad($text){
	$pad = ord($text[strlen($text)-1]);
	if ($pad > strlen($text)) return $text;
	if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return $text;
	return substr($text, 0, -1 * $pad);
}
function pkcs5_pad($text, $block = 8){
	$pad = $block - (strlen($text) % $block);
	return $text . str_repeat(chr($pad), $pad);
} 

function jsonEncode($data)
{
	return json_encode($data,JSON_UNESCAPED_UNICODE);
}

/**
 * 发送POST请求
 */
function send_post_json($url, $post_data) {
    $options = array(  
        'http' => array(  
            'method' => 'POST',  
            'header' => 'Content-type:application/x-www-form-urlencoded',  
            'content' => $post_data,  
            'timeout' => 15 * 60 // 超时时间（单位:s）  
        )  
    );  
    $context = stream_context_create($options);  
    $result = file_get_contents($url, false, $context);  
  
    return $result;  
}  

/**
 * 发送POST请求
 */
function send_post($url, $post_data) {
    $postdata=json_encode($post_data,JSON_UNESCAPED_UNICODE);  
    $options = array(  
        'http' => array(  
            'method' => 'POST',  
            'header' => 'Content-type:application/x-www-form-urlencoded',  
            'content' => $postdata,  
            'timeout' => 15 * 60 // 超时时间（单位:s）  
        )  
    );  
    $context = stream_context_create($options);  
    $result = file_get_contents($url, false, $context);  
  
    return $result;  
}  

/**
 * 发送GET请求
 */
function send_get($url) {
    //$postdata=json_encode($post_data,JSON_UNESCAPED_UNICODE);  
    $options = array(  
        'http' => array(  
            'method' => 'GET',  
            'header' => 'Content-type:application/x-www-form-urlencoded',             
            'timeout' => 15 * 60 // 超时时间（单位:s）  
        )  
    );  
    $context = stream_context_create($options);  
    $result = file_get_contents($url, false, $context);  
  
    return $result;  
} 

function decodeUnicode($str)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
        create_function(
            '$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);
}

/**
* 把数字1-1亿换成汉字表述，如：123->一百二十三
* @param [num] $num [数字]
* @return [string] [string]
*/
function numToWord($num)
{
	$chiNum = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
	$chiUni = array('','十', '百', '千', '万', '亿', '十', '百', '千');
	 
	$chiStr = '';
	 
	$num_str = (string)$num;
	 
	$count = strlen($num_str);
	$last_flag = true; //上一个 是否为0
	$zero_flag = true; //是否第一个
	$temp_num = null; //临时数字
	 
	$chiStr = '';//拼接结果
	if ($count == 2) {//两位数
	$temp_num = $num_str[0];
	$chiStr = $temp_num == 1 ? $chiUni[1] : $chiNum[$temp_num].$chiUni[1];
	$temp_num = $num_str[1];
	$chiStr .= $temp_num == 0 ? '' : $chiNum[$temp_num]; 
	}else if($count > 2){
	$index = 0;
	for ($i=$count-1; $i >= 0 ; $i--) { 
	$temp_num = $num_str[$i];
	if ($temp_num == 0) {
	if (!$zero_flag && !$last_flag ) {
	$chiStr = $chiNum[$temp_num]. $chiStr;
	$last_flag = true;
	}
	}else{
	$chiStr = $chiNum[$temp_num].$chiUni[$index%9] .$chiStr;
	 
	$zero_flag = false;
	$last_flag = false;
	}
	$index ++;
	}
	}else{
	$chiStr = $chiNum[$num_str[0]]; 
	}
	return $chiStr;
}

/**
* 判断字符是否base64编码
* @str
*/
function isBase64($str)
{
	return base64_encode(base64_decode($str)) ? true : false;	
}
//        随机字符串
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
//数组转换XML格式
 function array_to_xml( $params ){
    if(!is_array($params)|| count($params) <= 0)
    {
        return false;
    }
    $xml = "<xml>";
    foreach ($params as $key=>$val)
    {
        if (is_numeric($val)){
            $xml.="<".$key.">".$val."</".$key.">";
        }else{
            $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
        }
    }
    $xml.="</xml>";
    return $xml;
}
//  将xml转为array
//  @param string $xml
//  return array

function xml_to_array($xml){
    if(!$xml){
        return false;
    }
    //将XML转为array
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);
    $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    return $data;
}
/**
 * 将参数拼接为url: key=value&key=value
 * @param $params
 * @return string
 */
function ToUrlParams( $params ){
    $string = '';
    if( !empty($params) ){
        $array = array();
        foreach( $params as $key => $value ){
            $array[] = $key.'='.$value;
        }
        $string = implode("&",$array);
    }
    return $string;
}

/**
 * 生成签名, $KEY就是支付key
 * @return 签名
 */
function MakeSign( $params,$KEY){
    //签名步骤一：按字典序排序数组参数
    ksort($params);
    $string = ToUrlParams($params);  //参数进行拼接key=value&k=v
    //签名步骤二：在string后加入KEY
//    $string = $string . "&key=".$KEY;
    $string = $string . "&key=".$KEY;
    write_log($string);
    //签名步骤三：MD5加密
    $string = md5($string);
    //签名步骤四：所有字符转为大写
    $result = strtoupper($string);
    return $result;
}


function wxpost($url,$post)
{
    //初始化
    $curl = curl_init();
    $header[] = "Content-type: text/xml";//定义content-type为xml
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 1);
    //定义请求类型
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, 1);
    //设置post数据
    $post_data = $post;
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求

    //显示获得的数据
//        print_r($data);
    if ($data)
    {
        curl_close($curl);
        return $data;
    }else{
        $res = curl_error($curl);
        curl_close($curl);
        return $res;
    }

}

function getSession($key)
{
    $val = isset($_SESSION[PREFIX_SESSION.$key]) ? $_SESSION[PREFIX_SESSION.$key] : 0;
    return $val;
}

function setSession($key,$val)
{
    $_SESSION[PREFIX_SESSION.$key] = $val;
}

//距离计算
define('PI', 3.1415926535898);
function distance($x, $y)
{
	return " ROUND(
        6378.138 * 2 * ASIN(
            SQRT(
                POW(
                    SIN(
                        (
                            ".$y." * ".PI." / 180 - lat * PI() / 180
                        ) / 2
                    ),
                    2
                ) + COS(".$y." * ".PI." / 180) * COS(lat * ".PI." / 180) * POW(
                    SIN(
                        (
                            ".$x." * ".PI." / 180 - lng * ".PI." / 180
                        ) / 2
                    ),
                    2
                )
            )
        ) * 1000
    ) ";
}

/** 
* 取汉字首字母 
* @param string $str 字符串
*/  
function getStrOne($str){  
    if(empty($str)) return ''; 
 
    $fchar = ord($str[0]);  
    if($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str[0]);
 
    $s1 = iconv('UTF-8','GB2312//TRANSLIT//IGNORE',$str);  
    $s2 = iconv('GB2312','UTF-8//TRANSLIT//IGNORE',$s1);  
    $s = $s2==$str ? $s1 : $str;  
    $asc = @ord($s[0])*256+@ord($s[1])-65536;  
 
    if($asc>=-20319 && $asc<=-20284) return 'A';  
    if($asc>=-20283 && $asc<=-19776) return 'B';  
    if($asc>=-19775 && $asc<=-19219) return 'C';  
    if($asc>=-19218 && $asc<=-18711) return 'D';  
    if($asc>=-18710 && $asc<=-18527) return 'E';  
    if($asc>=-18526 && $asc<=-18240) return 'F';  
    if($asc>=-18239 && $asc<=-17923) return 'G';  
    if($asc>=-17922 && $asc<=-17418) return 'H';  
    if($asc>=-17417 && $asc<=-16475) return 'J';  
    if($asc>=-16474 && $asc<=-16213) return 'K';  
    if($asc>=-16212 && $asc<=-15641) return 'L';  
    if($asc>=-15640 && $asc<=-15166) return 'M';  
    if($asc>=-15165 && $asc<=-14923) return 'N';  
    if($asc>=-14922 && $asc<=-14915) return 'O';  
    if($asc>=-14914 && $asc<=-14631) return 'P';  
    if($asc>=-14630 && $asc<=-14150) return 'Q';  
    if($asc>=-14149 && $asc<=-14091) return 'R';  
    if($asc>=-14090 && $asc<=-13319) return 'S';  
    if($asc>=-13318 && $asc<=-12839) return 'T';  
    if($asc>=-12838 && $asc<=-12557) return 'W';  
    if($asc>=-12556 && $asc<=-11848) return 'X';  
    if($asc>=-11847 && $asc<=-11056) return 'Y';  
    if($asc>=-11055 && $asc<=-10247) return 'Z';  
    return '~';  
}

//过滤表情字符
function filterEmoji($str)
{
 $str = preg_replace_callback(
   '/./u',
   function (array $match) {
    return strlen($match[0]) >= 4 ? '' : $match[0];
   },
   $str);
 
  return $str;
 }

 function get_url_headers($url,$timeout=10){
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_HEADER,true);
	curl_setopt($ch,CURLOPT_NOBODY,true);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
	$data=curl_exec($ch);
	$data=preg_split('/\n/',$data);
	$data=array_filter(array_map(function($data){
		$data=trim($data);
		if($data){
			$data=preg_split('/:\s/',trim($data),2);
			$length=count($data);
			switch($length){
				case 2:
					return array($data[0]=>$data[1]);
					break;
				case 1:
					return $data;
					break;
				default:
					break;
			}
		}
	},$data));
	sort($data);
	foreach($data as $key=>$value){
		$itemKey=array_keys($value)[0];
		if(is_int($itemKey)){
			$data[$key]=$value[$itemKey];
		}elseif(is_string($itemKey)){
			$data[$itemKey]=$value[$itemKey];
			unset($data[$key]);
		}
	}
	$first = array_shift($data);
	$data[0] = $first;
	return $data;
}

function get_redirect_url($url){
	$header = get_url_headers(trim($url), 10);
	if(count($header) < 3){
		$header = get_headers(trim($url), true);
	}
	if (strpos($header[0], '301') !== false || strpos($header[0], '302') !== false) {
		if(isset($header['Location'])){
			$header['location'] = $header['Location'];
		}
		if(!isset($header['location'])){
			$header['location'] = '';
		}
		if(is_array($header['location'])) {
			return $header['location'][count($header['location'])-1];
		}else{
			return $header['location'];
		}
	}else {
		return $url;
	}
}

function convertUrlQuery($query){
	$urlarr = parse_url($query);
	$queryParts = explode('&', $urlarr['query']);
	
	$params = array();
	foreach ($queryParts as $param) {
		$item = explode('=', $param);
		$params[$item[0]] = $item[1];
	}
	
	return $params;
}

//四则运算
function precedence($operator) {
    if ($operator == '+' ||$operator == '-') {
        return 1;
    } elseif ($operator == '*' ||$operator == '/') {
        return 2;
    }
    return 0;
}

function applyOp($a,$b, $op) {
    switch ($op) {
        case '+': return $a +$b;
        case '-': return $a -$b;
        case '*': return $a *$b;
        case '/': 
            if ($b == 0) throw new Exception("除数不能为0");
            return $a /$b;
    }
    return 0;
}

function evaluate($expression) {
    $values = new SplStack();
    $ops = new SplStack();
    $i = 0;

    while ($i < strlen($expression)) {
        if ($expression[$i] == ' ') {
            $i++;
            continue;
        }

        if (is_numeric($expression[$i])) {
			$val = 0;
            $is_float = 0;
            $f=1;
            while ($i < strlen($expression) && (is_numeric($expression[$i]) || $expression[$i]=='.') ) { 
            	if($expression[$i]=='.') 
            		$is_float=1;
            	else
            	{            		
            		if($is_float)
            		{
						$f*=0.1;
            			$val += $expression[$i]*$f;
            		}            			
            		else 
                	$val =$val * 10 + (int)$expression[$i]; 
              }
              $i++;
            }
            $values->push($val);
            continue;
        }

        if ($expression[$i] == '(') {
            $ops->push($expression[$i]);
            $i++;
            continue;
        }

        if ($expression[$i] == ')') {
            while (!$ops->isEmpty() &&$ops->top() != '(') {
                $val2 =$values->pop();
                $val1 =$values->pop();
                $op =$ops->pop();
                $values->push(applyOp($val1, $val2,$op));
            }
            $ops->pop();
            $i++;
            continue;
        }

        while (!$ops->isEmpty() && precedence($ops->top()) >= precedence($expression[$i])) {
            $val2 =$values->pop();
            $val1 =$values->pop();
            $op =$ops->pop();
            $values->push(applyOp($val1, $val2,$op));
        }
        $ops->push($expression[$i]);
        $i++;
    }

    while (!$ops->isEmpty()) {
        $val2 =$values->pop();
        $val1 =$values->pop();
        $op =$ops->pop();
        $values->push(applyOp($val1, $val2,$op));
    }

    return $values->pop();
}

function is_valid_expression($expr) {
    $expr = str_replace(' ', '',$expr); // 移除字符串中的所有空格
	$pattern = '/^(\()*\d+(\.\d+)?([\+\-\*\/](\()*\d+(\.\d+)?(\))*)+$/';
		
    if(preg_match($pattern,$expr))
    	return substr_count($expr, "(") == substr_count($expr, ")");
    
    return 0;
}