<?php
$model= init_model("resource");
$model->__setTable("sys_res_file");
$model->__bindQuery("file_id", $this->in["file_id"]);
$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("file_name", $this->in["file_name"]);
$model->__mod();
$this->__exit(0);