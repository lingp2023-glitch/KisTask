<?php
/**
 * 程序路由处理类
 * 这里类判断外界参数调用内部方法
 */
class Application {
	public $default_controller = "app";	//默认的类名
	public $default_action = "index";			//默认的方法名
	public $default_subaction = ""; 
	public $sub_dir ='';				//控制器子目录
	public $model = '';				//控制器对应模型  对象。
	
	/**
	 * 设置默认的类名
	 * @param string $default_controller 
	 */
	public function setDefaultController($default_controller){
		$this -> default_controller = $default_controller;
	} 

	/**
	 * 设置默认的方法名
	 * @param string $default_action 
	 */
	public function setDefaultAction($default_action){
		$this -> default_action = $default_action;
	} 

	/**
	 * 设置控制器子目录
	 * @param string $dir 
	 */
	public function setSubDir($dir){
		$this -> sub_dir = $dir;
	} 

	/**
	 * 运行controller 的方法
	 * @param $class , controller类名。
	 * @param $function , 方法名
	 */
	public function appRun($class,$function){ 
		$sub_dir = $this -> sub_dir ? $this -> sub_dir . '/' : '';
		$class_file = CONTROLLER_DIR . $sub_dir.$class.'.class.php';
		if (!file_exists($class_file)) {
			show_tips($class.' controller not exists!');
		}
		if (!class_exists($class)) {
		    include($class_file);
		}
		if (!class_exists($class)) {
			show_tips($class.' class not exists');
		}
		$instance = new $class();
		if (!method_exists($instance, $function)) {
			show_tips($function.' method not exists');
		}
		return $instance -> $function();
	}


	/**
	 * 运行自动加载的控制器
	 */
	private function autorun(){
		global $config; 
		if (count($config['autorun']) > 0) {
			foreach ($config['autorun'] as $key => $var) {
				$this->appRun($var['controller'],$var['function']);				
			}
		} 
	}

	/**
	 * 调用实际类和方式
	 */
	public function run(){
		$URI = $GLOBALS['in']['URLremote']; 
		if (!isset($URI[0]) || $URI[0] == '') $URI[0] = $this->default_controller;
		if (!isset($URI[1]) || $URI[1] == '') $URI[1] = $this->default_action;
		if (!isset($URI[2]) || $URI[2] == '') $URI[2] = $this->default_subaction;

		define('ST',$URI[0]);
		define('ACT',$URI[1]);
		define('SUB_ACT',$URI[2]);		
						
		//自动加载运行类。
		$this->autorun();
		$this->appRun(ST,ACT);
	}
} 
