<?php
$files = json_decode($this->in["files"], true);
$group_id = empty($this->in["group_id"])?0:$this->in["group_id"];
$model= init_model("resource");
$model->__setTable("sys_res_file");

//个人用户上传目录
$dir = "upload/files/".date("Y")."/".date("m")."/";
mk_dir($dir);
    
foreach($files as $f)
{
    //将文件从临时目录移动到存储目录    
    $file_name = basename($f["file"]);
    $file = $dir.$file_name;
    rename(DOCUMENT_ROOT.$f["file"], DOCUMENT_ROOT.$file);

    $model->__bind("userid", $this->user["userid"]);
    $model->__bind("group_id", $group_id);
    $model->__bind("file", $file);
    $model->__bind("file_name", $f["file_name"]);
    $model->__bind("file_size", $f["file_size"]);
    $model->__bind("file_type", $f["file_type"]);
    $model->__bind("create_time", showtime());
    $model->__add();
}

$this->__exit(0);