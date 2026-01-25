<?php
$audios = json_decode($this->in["audios"], true);
$model= init_model("resource");
$model->__setTable("sys_res_audio");
$model->__bindQuery("audio_id", implode(",", $audios), "in");	
$model->__bind("is_del", 1);
$model->__bind("del_time", showtime());
$model->__mod();	
$this->__exit(0);