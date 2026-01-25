<?php
$model = init_submodel("group", "group");
$pid = empty($this->in["pid"])?0:$this->in["pid"];
$srot = empty($this->in["sort"])?0:$this->in["sort"];
$model->__bind("group_name", $this->in["group_name"]);
$model->__bind("sort", $srot);
$model->__bind("pid", $pid);
if(isset($this->in["group_attrs"])) $model->__bind("group_attrs", preg_replace('/\s+/', ' ', $this->in["group_attrs"]) );
if(isset($this->in["group_img"])) $model->__bind("group_img", $this->in["group_img"]);
if(isset($this->in["is_green"])) $model->__bind("is_green", $this->in["is_green"]);

$model->__bind("create_time", showtime());
$model->__add();
$this->__exit(0);