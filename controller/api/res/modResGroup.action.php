<?php
$group_name = $this->in["group_name"];
$group_id = $this->in["group_id"];
$model= init_model("resourceGroup");
$model->__bind("group_name",$group_name);
$model->__bindQuery("group_id", $group_id);
$model->__mod();