<?php
$group_id = $this->in["group_id"];
$page = empty($this->in["page"])?1:$this->in["page"];

$model= init_model("resource");
$model->__setTable("sys_res_video");
//$model->__bindQuery("userid", $this->user["userid"]);
$model->__bindQuery("is_del", 0);
$model->__bindQuery("group_id", $this->in["group_id"]);	
    
$data = $model->__pageList($page);
$this->__exit(0, "", $data);