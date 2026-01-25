<?php
$flow_id = $this->in["flow_id"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("flow_id", $flow_id);
$data = $modelFlow->__getRow();
$status = ($data)?json_decode($data["status"], true):[];

$this->__exit(0, '', $status);