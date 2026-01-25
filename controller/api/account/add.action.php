<?php
$model = init_submodel("account", "account");
$user = $model->__getRow("phone", $this->in["phone"]);
if($user) $this->__exit(-1, "手机号已添加");

$rand_code = mt_rand(1000, 9999);
$pwd = md5($rand_code.$this->in["password"]);

$model->__bind("name", $this->in["name"]);
$model->__bind("phone", $this->in["phone"]);
$model->__bind("roleid", $this->in["roleid"]);
$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("password", $pwd);
$model->__bind("rand_code", $rand_code);
$model->__add();		
$this->__exit(0);