<?php
$rand_code = mt_rand(1000, 9999);
$pwd = md5($rand_code.$this->in["user_pass"]);
$model = init_submodel("account", "account");
$model->__bind("password", $pwd);
$model->__bind("rand_code", $rand_code);	
$model->__bindQuery("userid", $this->in["userid"]);	
$model->__mod();
$this->__exit(0);