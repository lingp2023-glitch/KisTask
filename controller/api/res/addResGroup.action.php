<?php
$group_name = $this->in["group_name"];
$group_type = empty($this->in["group_type"])?1:$this->in["group_type"];
$model= init_model("resourceGroup");
$model->__bind("userid", $this->user["userid"]);
$model->__bind("group_type",$group_type);
$model->__bind("group_name",$group_name);
$model->__add();

$model->__bindQuery("group_type", $group_type);
$group_id = $model->__max("group_id");
$data = array("group_id"=>$group_id, "group_name"=>$group_name);
$this->__exit(0, "", $data);