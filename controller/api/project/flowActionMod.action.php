<?php
$flow_id = $this->in["flow_id"];
$actions = $this->in["actions"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("flow_id", $flow_id);
$modelFlow->__bind("actions", $actions);
$modelFlow->__mod();
$this->__exit(0);
