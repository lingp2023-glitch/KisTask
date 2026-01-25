<?php
class issueWorkModel extends tableModel
{
	protected function __init()    
	{
		$this->__setTable("tb_issue_work");
	}

	public function workers($issue_id, $status)
	{
		$this->__join("sys_account");
		$this->__bindQuery("tb_issue_work.issue_id", $issue_id);
		$this->__bindQuery("tb_issue_work.estatus", $status);
		$this->__joinQuery("tb_issue_work.userid", "sys_account.userid");
		$workers = $this->__list(["tb_issue_work.userid, sys_account.name"]);
		return $workers;
	}
}