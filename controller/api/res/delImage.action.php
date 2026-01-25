<?php
$imgs = json_decode($this->in["imgs"], true);
$model= init_model("resource");
$model->__setTable("sys_res_image");
$model->__bindQuery("image_id", implode(",", $imgs), "in");
$model->__bind("is_del", 1);
$model->__bind("del_time", showtime());
$model->__mod();
$this->__exit(0);