<?php
	if(empty($this->in["refresh_token"])) 
  $this->__exit(-1005, "请求参数错误");

  $model = init_submodel("account", "account");
  $user = $model->__getRow("refresh_token", $this->in["refresh_token"]); 
  if(empty($user))
    $this->__exit(-1003, "请重新登录");
    
  $data = $model->refreshToken($user["userid"]);
  $this->__exit(0, "", $data);		