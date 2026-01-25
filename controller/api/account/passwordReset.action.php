<?php
$password = $this->in["password"];
if(!$password) $this->__exit(-1, "密码不能为空！");

$rand_code = mt_rand(1000, 9999);
$pwd = md5($rand_code.$password);

$model = init_submodel("account", "account");
$model->__bind("password", $pwd);
$model->__bind("rand_code", $rand_code);
$model->__bindQuery("userid", $this->user["userid"]);
$model->__mod();

$this->__exit(0);