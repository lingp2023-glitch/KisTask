<?php
$model = init_submodel("group", "group");
$ids = json_decode($this->in["group_ids"], true);
if(empty($ids)) $this->__exit(0);

$model->__bindQuery("group_id", implode(",", $ids), "in");
$model->__del();
$this->__exit(0);