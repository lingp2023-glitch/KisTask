<?php
$model = init_submodel("role", "account");
$model->__bind("role_name", $this->in["role_name"]);
if(isset($this->in["role_grade"])) $model->__bind("role_grade", $this->in["role_grade"]);
$model->__bindQuery("roleid", $this->in["roleid"]);
$model->__mod();
$this->__exit(0, 'api request ok');