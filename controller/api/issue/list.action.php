<?php
global $config;
$page = empty($this->in["page"])?1:$this->in["page"];
$query_str = isset($this->in["query_str"])?$this->in["query_str"]:"";
$query_code = $this->in["query_code"];
$userid = $this->user["userid"];

$modelIssue = init_submodel("issue", "issue");
if(!empty($query_str)) 
    $modelIssue->__bindQuery("title", $query_str, "like");
switch($query_code)
{
    case "work": //待办
        $modelIssue->__bindQuery("issue_id", "select issue_id from tb_issue_work where userid={$userid} and is_finish=0", "in");
        break;
    case "finish"://已办
        $modelIssue->__bindQuery("issue_id", "select issue_id from tb_issue_work where userid={$userid} and is_finish=1", "in");
        break;
    case "create"://已创建
        $modelIssue->__bindQuery("creater", $userid);
        break;
}

$data = $modelIssue->__pageList($page); 
$modelFlow = init_submodel("flow", "project");
for($i=0; $i<$data["num"];$i++)
{
    $flow = $modelFlow->__getRow("flow_id", $data["list"][$i]["flow_id"]);
    $data["list"][$i]["flow_name"] = $flow["name"];

    $data["list"][$i]["priority_name"] = $config["priority"][$data["list"][$i]["priority"]];
    $data["list"][$i]["severity_name"] = $config["severity"][$data["list"][$i]["severity"]];
    $modelIssueWorker = init_submodel("issueWork", "issue");
    $data["list"][$i]["workers"] = $modelIssueWorker->workers($data["list"][$i]["project_id"], $data["list"][$i]["status"]);

    $modelAcct = init_submodel("account", "account"); 
    $user = $modelAcct->__getRow("userid", $data["list"][$i]["creater"]);
    $data["list"][$i]["creater_name"] = $user["name"];
}

$this->__exit(0, "", $data);