<?php
$userid = $this->user["userid"];
$issue_id = $this->in["issue_id"];
$status = $this->in["status"];
$content = $this->in["content"];
$workers = json_decode($this->in["workers"], true);

$modelIssue = init_submodel("issue", "issue");
$issue = $modelIssue->__getRow("issue_id", $issue_id);

//添加处理内容
$modelWork = init_submodel("issueWork", "issue"); 
$modelWork->__bindQuery("issue_id", $issue_id);
$modelWork->__bindQuery("userid", $userid);
$modelWork->__bindQuery("estatus", $issue["status"]);
$modelWork->__bindQuery("is_finish", 0);
$work = $modelWork->__getRow();
if($work)
{
    $modelWork->__bind("is_finish", 1);
    $modelWork->__bind("content", $content);
    $modelWork->__bind("work_time", showtime());
    $modelWork->__mod();
}
else
{
    $modelWork->__bind("issue_id", $issue_id);
    $modelWork->__bind("userid", $userid);
    $modelWork->__bind("estatus", $issue["status"]);
    $modelWork->__bind("is_finish", 1);
    $modelWork->__bind("content", $content);
    $modelWork->__bind("work_time", showtime());
    $modelWork->__add();
}

//添加下一状态处理人员
foreach($workers as $w)
{
    $modelWork->__bind("issue_id", $issue_id);
    $modelWork->__bind("userid", $w);
    $modelWork->__bind("bstatus", $issue["status"]);
    $modelWork->__bind("estatus", $status);
    $modelWork->__add();
}

//更新事务状态
$modelIssue->__bindQuery("issue_id", $issue_id);
$modelIssue->__bind("status", $status);
$modelIssue->__mod();

$this->__exit(0);