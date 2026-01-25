<?php
$group_id = empty($this->in["group_id"])?0:$this->in["group_id"];
$imgs = json_decode($this->in["imgs"], true);
$modelRes = init_model("resource"); 
$modelRes->__setTable("sys_res_image");

//创建存储目录
$dir = date("Y")."/".date("m")."/";
$img_dir = "upload/image/".$dir;
mk_dir($img_dir);
$modelImg = init_model("img");

foreach($imgs as $img)
{
	$file_size = filesize(DOCUMENT_ROOT.$img["file"]);
	if($file_size>(MAX_UPLOAD_SIZE*1024*1024)) $this->__exit(-1, "图片大小超过最大限制".MAX_UPLOAD_SIZE."MB");
    $modelImg->stockIn($img["file"], $img["name"], $group_id, $this->user["userid"]);
}

$this->__exit(0, "新增成功");