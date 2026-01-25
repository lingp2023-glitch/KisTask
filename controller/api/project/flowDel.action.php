<?php
$flow_id = $this->in["flow_id"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("flow_id", $flow_id);
$modelFlow->__del();
$this->__exit(0);