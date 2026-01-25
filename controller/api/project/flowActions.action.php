<?php
$flow_id = $this->in["flow_id"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("flow_id", $flow_id);
$data = $modelFlow->__getRow(); 
$actions = ($data)?json_decode($data["actions"], true):[];

$this->__exit(0, '', $actions);
/*
[
    {"src_status":"A", "dst_status":["B"]},
    {"src_status":"B", "dst_status":["B", "C"]},
    {"src_status":"C", "dst_status":["B"]},
    {"src_status":"D", "dst_status":["B", "C"]}
]*/