<?php
$model = init_submodel("group", "group");
$data = $model->getGroupList(0, true);
$this->__exit(0, "", $data);
