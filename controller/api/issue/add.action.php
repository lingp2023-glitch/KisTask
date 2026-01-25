<?php
$userid = $this->user["userid"];
$project_id = $this->in["project_id"];
$flow_id = $this->in["flow_id"];
$workers = json_decode($this->in["workers"], true);
$btime = $this->in["btime"];
$etime = $this->in["etime"];

//获取流程初始状态
$modelFlow = init_submodel("flow", "project");
$status = $modelFlow->beginStatus($project_id, $flow_id);

//添加事务
$modelIssue = init_submodel("issue", "issue");
$modelIssue->__bind("project_id", $project_id);
$modelIssue->__bind("flow_id", $flow_id);
$modelIssue->__bind("creater", $userid);
$modelIssue->__bind("title", $this->in["title"]);
$modelIssue->__bind("status", $status);
$modelIssue->__bind("content", $this->in["content"]);
$modelIssue->__bind("severity", $this->in["severity"]);
$modelIssue->__bind("priority", $this->in["priority"]);
$modelIssue->__bind("btime", $this->in["btime"]);
$modelIssue->__bind("etime", $this->in["etime"]);
$modelIssue->__bind("create_time", showtime());
$issue_id = $modelIssue->__add();

//添加处理人员
$modelWork = init_submodel("issueWork", "issue"); 
foreach($workers as $w)
{
    $modelWork->__bind("issue_id", $issue_id);
    $modelWork->__bind("userid", $w);
    $modelWork->__bind("estatus", $status);
    //$modelWork->__bind("btime", $this->in["btime"]);
    //$modelWork->__bind("etime", $this->in["etime"]);
    $modelWork->__add();
}

$this->__exit(0);