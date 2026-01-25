<?php
$flow_id = $this->in["flow_id"];
$modelFlow = init_submodel("flow", "project");
$data = $modelFlow->__getRow("flow_id", $flow_id);
$this->__exit(0, '', $data);