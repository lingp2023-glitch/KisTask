<?php
$issue_id = $this->in["issue_id"];
$modelIssue = init_submodel("issue", "issue");
$issue = $modelIssue->__bindQuery("issue_id", $issue_id);
$modelIssue->__bind("content", $this->in["content"]);
$modelIssue->__mod();
$this->__exit(0);