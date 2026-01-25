<?php
/**
 * 控制器抽象类
 */
abstract class Controller {	
	public $in;
	public $db;
	public $config;	// 全局配置
	public $tpl;	// 模板目录
	public $values;	// 模板变量
	public $L;
	private $ret;
	
	/**
	 * 构造函数
	 */
	function __construct(){
		global $in,$config,$db,$L;
    session_start();
		
		$this -> db  = $db;
		$this -> L 	 = $L;
		$this -> config = &$config;
		$this -> in = &$in;	
		$this -> values['config'] = &$config;
		$this -> values['in'] = &$in;		
		$this->ret = array();
		$this->setResCode(0);
		$this->setResMsg("");
		
		if(GLOBAL_DEBUG) write_log(json_encode($this->in, JSON_UNESCAPED_UNICODE), ST);
		$this->__init();
	} 
	
	protected function __init(){}
	protected function setResCode($code){ $this->ret["code"] = $code; }
  protected function setData($code){ $this->ret["data"] = $code; }
  protected function setResMsg($msg){ $this->ret["msg"] = $msg; }
  protected function setResParam($param, $val){ $this->ret[$param]=$val; }
  protected function setResData($data){ $this->ret["data"] = $data; }
	protected function echoRes(){echo json_encode($this->ret, JSON_UNESCAPED_UNICODE);}
  protected function __exit($code, $msg="", $data="")
  {
  	$this->setResCode($code);
  	//if(!empty($msg)) 
		$this->setResMsg($msg);
  	//if(!empty($data)) 
		$this->setResData($data);
  	$this->echoRes();
  	exit;
  } 
  
   
	/**
	 * 加载模型
	 * @param string $class 
	 */
	public function loadModel($class){
		$args = func_get_args();
		$this -> $class = call_user_func_array('init_model', $args);
		return $this -> $class;
	} 

	/**
	 * 加载类库文件
	 * @param string $class 
	 */
	public function loadClass($class){
		if (1 === func_num_args()) {
			$this -> $class = new $class;
		} else {
			$reflectionObj = new ReflectionClass($class);
			$args = func_get_args();
			array_shift($args);
			$this -> $class = $reflectionObj -> newInstanceArgs($args);
		}
		return $this -> $class;
	}

	/**
	 * 显示模板
	 * 
	 * TODO smarty
	 * @param
	 */
	protected function assign($key,$value){
		$this->values[$key] = $value;
	} 
	/**
	 * 显示模板
	 * @param
	 */
	protected function display($tpl_file){
		global $L,$LNG;
		ob_end_clean();
		extract($this->values);
		require($this->tpl.$tpl_file);
	} 
}