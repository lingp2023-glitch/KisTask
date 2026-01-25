<?php
$project_id = $this->in["project_id"];
$name = $this->in["name"];
$intro = $this->in["intro"];
$modelFlow = init_submodel("flow", "project");
$modelFlow->__bindQuery("project_id", $project_id);
$modelFlow->__bindQuery("name", $name);
if($modelFlow->__count()>0) $this->__exit(-1, "相同的流程名不能重复添加");

$modelFlow->__bind("project_id", $project_id);
$modelFlow->__bind("name", $name);
$modelFlow->__bind("intro", $intro);
$flow_id = $modelFlow->__add();
$this->__exit(0, "", ["flow_id"=>$flow_id]);