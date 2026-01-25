<?php
global $config;
$issue_id = $this->in["issue_id"];
$modelIssue = init_submodel("issue", "issue");
$data = $modelIssue->__getRow("issue_id", $issue_id);
$data["severity_name"] = $config["severity"][$data["severity"]];
$data["priority_name"] = $config["priority"][$data["priority"]];

$modelFlow = init_submodel("flow", "project"); 
$dst_status = $modelFlow->dstStatus($data["status"], $data["project_id"], 0);
$data["dst_status"] = $dst_status;

$flow = $modelFlow->__getRow("flow_id", $data["flow_id"]);
$data["flow_name"] = $flow["name"];

$modelUser = init_submodel("account", "account"); 
$user = $modelUser->__getRow("userid", $data["creater"]);
$data["creater_name"] = $user["name"];

$modelIssueWorker = init_submodel("issueWork", "issue");
$data["workers"] = $modelIssueWorker->workers($data["project_id"], $data["status"]);

$this->__exit(0, '', $data);