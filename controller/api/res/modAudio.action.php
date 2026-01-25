<?php
$model= init_model("resource");
$model->__setTable("sys_res_audio");

$model->__bind("group_id", $this->in["group_id"]);
$model->__bind("file_name", $this->in["file_name"]);
$model->__bind("duration", $this->in["duration"]); 
$model->__bindQuery("audio_id", $this->in["audio_id"]);	
$model->__mod();

$this->__exit(0);