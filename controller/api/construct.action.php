<?php
if(empty($this->in["timestamp"]) 
	 || empty($this->in["sign"]))
	  $this->__exit(-1000, "非法调用");
 
$timestamp = $this->in["timestamp"];
$sign = $this->in["sign"];
if($sign != md5(APPKEY.APPSECERT.$timestamp)) 
$this->__exit(-1001, "签名错误");

//不需要检查用户Token的行为
$acts = ["loginCheck"];
$sub_acts = ["oauth/login", "oauth/refreshToken"];

if( !in_array(ACT, $acts) && !in_array(ACT."/".SUB_ACT, $sub_acts))
{
	if(empty($this->in["token"])) $this->__exit(-1002, "token为空");

	$token = $this->in["token"];
	if(empty($token)) exit;
	
	$model = init_submodel("account", "account"); 
	$user = $model->__getRow("token", $token);
	if(empty($user))  $this->__exit(-1003, "token不匹配");
			
	if($user["token_exptime"]<showtime()) 
		$this->__exit(-1004, "token过期");
	
	$model = init_submodel("role", "account");
	$role = $model->__getRow("roleid", $user["roleid"]);
	$user["role_grade"] = ($role)?json_decode($role["role_grade"], true):"";
	$this->user = $user;
}