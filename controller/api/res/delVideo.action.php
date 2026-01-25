<?php
$videos = json_decode($this->in["videos"], true);
$model= init_model("resource");
$model->__setTable("sys_res_video");	
$model->__bindQuery("video_id", implode(",", $videos), "in");
$model->__bind("is_del", 1);
$model->__bind("del_time", showtime());
$model->__mod();
$this->__exit(0);