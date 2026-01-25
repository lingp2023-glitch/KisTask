<?php
$image_id = $this->in["image_id"];
$model= init_model("resource");
$model->__setTable("sys_res_image");
$model->__bindQuery("image_id", $image_id);
$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("file_name", $this->in["file_name"]);
$model->__mod();
$this->__exit(0);