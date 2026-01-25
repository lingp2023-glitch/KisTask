<?php
if(!isset($this->in["phone"])) $this->__exit(-1, "手机号不能为空！");
$phone = $this->in["phone"];
if(!checkMobile($phone)) $this->__exit(-2, "非法手机号！");

$token = $this->in["token"];
$modelSms = init_submodel("sms", "user");
$key = "sms_".$token;
$v = $modelSms->__redisGet($key);
if($v) $this->__exit(-3, "请求发送手机短信过于频繁！");
$modelSms->__redisSet($key, 1, 60);

$result = $modelSms->sendVerifySms($phone);
$ret_code = ($result["code"]==200)?0:-2;
$this->__exit($ret_code);
