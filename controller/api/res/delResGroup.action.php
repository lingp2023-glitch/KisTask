<?php
$group_id = $this->in["group_id"];
$model= init_model("resourceGroup");
$group = $model->__getRow("group_id", $group_id);

//修改资源分组
$modelRes = init_model("resource");
switch($group["group_type"])
{
    case RES_TYPE_IMG:
        $modelRes->__setTable("sys_res_image");
    break;
    case RES_TYPE_AUDIO:
        $modelRes->__setTable("sys_res_audio");
    break;
    case RES_TYPE_VIDEO:
        $modelRes->__setTable("sys_res_video");
    break;
    case RES_TYPE_FILE:
        $modelRes->__setTable("sys_res_file");
    break;
    case RES_TYPE_DOC:
        $modelRes->__setTable("sys_res_doc");
    break;
}
$modelRes->__bind("group_id", 0);
$modelRes->__bindQuery("group_id", $group_id);
$modelRes->__mod();	

//删除分组
$model->__bindQuery("group_id", $group_id);
$model->__del();
$this->__exit(0);