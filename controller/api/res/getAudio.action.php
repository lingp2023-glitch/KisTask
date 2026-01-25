<?php
$model= init_model("resource");
$model->__setTable("sys_res_audio");
$data=$model->__getRow("audio_id", $this->in["audio_id"]);
$this->__exit(0, "", $data);