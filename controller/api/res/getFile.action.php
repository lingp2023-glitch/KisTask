<?php
$model= init_model("resource");
$model->__setTable("sys_res_file");
$data = $model->__getRow("file_id", $this->in["file_id"]);
$this->__exit(0, "", $data);