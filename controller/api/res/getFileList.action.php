<?php
$page = empty($this->in["page"])?1:$this->in["page"];
$group_id=empty($this->in["group_id"])?0:$this->in["group_id"];

$model= init_model("resource");
$model->__setTable("sys_res_file");
//$model->__bindQuery("userid", $this->user["userid"]);
$model->__bindQuery("is_del", 0);
$model->__bindQuery("group_id", $group_id);
    
$data = $model->__pageList($page);
$this->__exit(0, "", $data);