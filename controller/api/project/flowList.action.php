<?php
$project_id = $this->in["project_id"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("project_id", $project_id);
$data = $modelFlow->__list(["flow_id, name"]);
$this->__exit(0, '', $data);