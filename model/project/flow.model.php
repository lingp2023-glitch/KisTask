<?php
class flowModel extends tableModel
{
	protected function __init()    
	{
		$this->__setTable("tb_project_flow");
	}

	public function beginStatus($project_id, $flow_id)
	{
		$this->__bindQuery("project_id", $project_id);
		//$this->__bindQuery("flow_id", $flow_id);
		$data = $this->__getRow();
		if(!$data) return "";

		$status = json_decode($data["status"], true);
		foreach($status as $s)
		{
			if($s["is_begin"]) return $s["name"];
		}

		return "";
	}

	public function dstStatus($status, $project_id, $flow_id)
	{
		$this->__bindQuery("project_id", $project_id);
		//$this->__bindQuery("flow_id", $flow_id);
		$data = $this->__getRow();
		$actions = json_decode($data["actions"], true);
		foreach($actions as $a)
		{
			if($a["src_status"]==$status) return $a["dst_status"];
		}

		return "";
	}
}