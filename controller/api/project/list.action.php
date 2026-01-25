<?php
$page = empty($this->in["page"])?1:$this->in["page"];
$query_str = isset($this->in["query_str"])?$this->in["query_str"]:"";

$modelProject = init_submodel("project", "project");
if(!$query_str) $modelProject->__bindQuery("name", $query_str, "like");
$data = $modelProject->__pageList($page); 

$modelFlow = init_submodel("flow", "project");
for($i=0; $i<$data["num"];$i++)
{
    if($data["list"][$i]["logo"]) $data["list"][$i]["logo"] = DOMAIN.$data["list"][$i]["logo"];
    $modelFlow->__bindQUery("project_id", $data["list"][$i]["id"]);
    $data["list"][$i]["flows"] = $modelFlow->__list(["flow_id, name"]);
}

$this->__exit(0, "", $data);