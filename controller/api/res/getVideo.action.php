<?php
$model= init_model("resource");
$model->__setTable("sys_res_video");		
$data = $model->__getRow("video_id", $this->in["video_id"]);
$this->__exit(0, "", $data);