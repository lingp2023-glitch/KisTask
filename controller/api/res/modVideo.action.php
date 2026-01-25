<?php
$model= init_model("resource");
$model->__setTable("sys_res_video");	
$model->__bindQuery("video_id", $this->in["video_id"]);
$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("file_name", $this->in["file_name"]);
$model->__bind("duration", $this->in["duration"]);
$model->__mod();
$this->__exit(0);	