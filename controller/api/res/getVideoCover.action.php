<?php
$time = 1; 		//默认截取第一秒第一帧
$file_size = '320x240';
$file_url = $this->in["file_url"];
$img_file = "upload/video/cover/".basename($file_url, ".mp4").".jpg";
$str = " ".$_SERVER["DOCUMENT_ROOT"]."/ffmpeg/bin/ffmpeg.exe -i ".$file_url." -y -f mjpeg -ss ".$time." -t 0.001 -s ".$file_size." ".$img_file."  2>&1";       
exec($str, $output, $return_val);
$duration = substr(strstr(json_encode($output),"Duration"), 10, 8);

$this->__exit(0, "", array("cover"=>$img_file, "duration"=>$duration));