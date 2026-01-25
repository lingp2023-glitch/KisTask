<?php
$flow_id = $this->in["flow_id"];
$status = $this->in["status"];
$actions = $this->in["actions"];
$chart = $this->in["chart"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("flow_id", $flow_id);
$modelFlow->__bind("status", $status);
$modelFlow->__bind("actions", $actions);
$modelFlow->__bind("chart", $chart);
$modelFlow->__mod();
$this->__exit(0);
