<?php
class resourceModel extends tableModel
{	
	public function checkDuration()
	{
		$sql = "select * from sys_res_audio order by audio_id";
		$result = $this->pdo->query($sql);
		foreach($result as $item)
		{
			$str = " ".$_SERVER["DOCUMENT_ROOT"]."/ffmpeg/bin/ffmpeg.exe -i ".$item["file_dir"]."  2>&1"; echo $str;
    		exec($str, $output, $return_val);
    		$duration = substr(strstr(json_encode($output),"Duration"), 10, 8);
    		$sql = "update sys_res_audio set file_time='".$duration."' where audio_id=".$item["audio_id"];
    		$this->__execSql($sql);
		}
	}

	public function getImg($image_id)
	{
		$this->__setTable("sys_res_image");
		$img = $this->__getRow("image_id", $image_id);
		return $img;
	}

	public function getAudio($audio_id)
	{
		$this->__setTable("sys_res_audio");
		$audio = $this->__getRow("audio_id", $audio_id);
		return $audio;
	}

	public function getVideo($id, $fds=["*"])
	{
		$this->__setTable("sys_res_video");
		$v = $this->__getRow("video_id", $id, $fds);
		return $v;
	}

	//已使用
	public function size($userid, $tb)
	{
		$this->__setTable($tb);
		$this->__groupBy("userid", $userid);
		$fds = ["sum(file_size) file_size"];
		$file = $this->__getRow("", "", $fds);
		return ($file)?$file["file_size"]:0;
	}
}