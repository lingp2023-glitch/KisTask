<?php
global $config;
$page = empty($this->in["page"])?1:$this->in["page"];
$issue_id = isset($this->in["issue_id"])?$this->in["issue_id"]:"";

$modelWork = init_submodel("issueWork", "issue");
$modelWork->__bindQuery("issue_id", $issue_id);
$data = $modelWork->__pageList($page, ["work_id, issue_id, userid, bstatus, estatus, content, work_time"]); 

for($i=0; $i<$data["num"];$i++)
{
    $modelAcct = init_submodel("account", "account"); 
    $user = $modelAcct->__getRow("userid", $data["list"][$i]["userid"]);
    $data["list"][$i]["work_name"] = $user["name"];
}

$this->__exit(0, "", $data);