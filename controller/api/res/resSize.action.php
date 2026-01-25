<?php
$model= init_model("resource");
		
$img_size = $model->size($this->user["userid"], "sys_res_image");
$audio_size = $model->size($this->user["userid"], "sys_res_audio");
$video_size = $model->size($this->user["userid"], "sys_res_video");
$used_size = $img_size + $audio_size + $video_size;
$data = ["MAX_SIZE"=>MAX_STORE_SIZE, "used_size"=>$used_size, "img_size"=>$img_size, "audio_size"=>$audio_size, "video_size"=>$video_size];
$this->__exit(0, "", $data);