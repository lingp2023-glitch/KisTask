<?php
$files = json_decode($this->in["files"], true);
$model= init_model("resource");
$model->__setTable("sys_res_file");
$data = $model->__bindQuery("file_id", implode(",", $files), "in");
$model->__bind("is_del", 1);
$model->__bind("del_time", showtime());
$model->__mod();
$this->__exit(0);