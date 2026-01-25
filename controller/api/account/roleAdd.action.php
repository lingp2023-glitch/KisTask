<?php
$model = init_submodel("role", "account");
$model->__bind("role_name", $this->in["role_name"]);
$model->__bind("role_grade", $this->in["role_grade"]);
$model->__bind("create_time", showtime());
$model->__add();
$this->__exit(0);