<?php
$model = init_submodel("group", "group");
$pid = empty($this->in["pid"])?0:$this->in["pid"];
$data = $model->getGroupList($pid, false);
$this->__exit(0, "", $data);
