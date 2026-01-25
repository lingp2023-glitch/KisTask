<?php
$audio_file = $this->in["audio_file"];
$str = " ".$_SERVER["DOCUMENT_ROOT"]."/ffmpeg/bin/ffmpeg.exe -i ".$audio_file."  2>&1"; 
exec($str, $output, $return_val);
$duration = substr(strstr(json_encode($output),"Duration"), 10, 8);

$this->__exit(0, "", array("duration"=>$duration));