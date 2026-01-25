<?php
$model = init_submodel("account", "account");
$model->__bind("name", $this->in["name"]);
//$model->__bind("headimg", $this->in["headimg"]);
$model->__bindQuery("userid", $this->user["userid"]);
$model->__mod();
$this->__exit(0);