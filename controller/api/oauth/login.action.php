<?php
if (!isset($this->in['phone']) 
    || !isset($this->in['password']))
  $this->__exit(-1, "参数不完整");

$phone = rawurldecode($this->in['phone']);
$password = rawurldecode($this->in['password']);

$model = init_submodel("account", "account");
$user = $model->__getRow('phone', $phone); 
if(empty($user)) $this->__exit(-2, "用户不存在");			
if(md5($user["rand_code"].$password) != strtolower($user["password"]))  $this->__exit(-3, "密码错误");

$data = $model->refreshToken($user["userid"]);

$this->__exit(0, "", $data);