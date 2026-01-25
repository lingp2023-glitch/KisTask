<?php
	$group_type = empty($this->in["group_type"])?1:$this->in["group_type"];
    $model= init_model("resourceGroup");
    $model->__bindQuery("group_type", $group_type, "=");
    $model->__bindQuery("userid", $this->user["userid"]);
    $data = $model->__list();
    $this->__exit(0, "", $data);