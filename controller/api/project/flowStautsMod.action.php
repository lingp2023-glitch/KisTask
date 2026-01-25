<?php
$flow_id = $this->in["flow_id"];
$status_info = $this->in["status"];

//初始化actions
$modelFlow = init_submodel("flow", "project");
$modelFlow = init_submodel("flow", "project");

$data = $modelFlow->__getRow("flow_id", $flow_id);
$actions = ($data)?json_decode($data["actions"], true):[];
$status =  json_decode($status_info, true);

$new_actions = [];
foreach($status as $s)
{
    $act = ["src_status"=>$s["name"], "dst_status"=>[]];
    if($actions)
    {
        foreach($actions as $a)
        {   
            if($a["src_status"]==$s["name"]) 
            {
                $act["dst_status"] = $a["dst_status"];
                break;
            }
        }
    }
    array_push($new_actions, $act);
}

$actions_info = json_encode($new_actions, JSON_UNESCAPED_UNICODE);
//$modelFlow->__bind("project_id", $project_id);
$modelFlow->__bindQuery("flow_id", $flow_id);
$modelFlow->__bind("status", $status_info);
$modelFlow->__bind("actions", $actions_info);
$modelFlow->__mod();

$this->__exit(0);