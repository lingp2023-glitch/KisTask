<?php
$model = init_submodel("account", "account");
$model->__bind("name", $this->in["name"]);
$model->__bind("phone", $this->in["phone"]);
$model->__bind("email", $this->in["email"]);
$model->__bind("roleid", $this->in["roleid"]);
$model->__bind("group_id", $this->in["group_id"]);
$model->__bindQuery("userid", $this->in["userid"]);	
$model->__mod();		
$this->__exit(0, '');