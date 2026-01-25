<?php
class groupModel extends tableModel
{
	protected function __init()    
	{
		$this->__setTable("tb_group");
	}
	
	//获取分组信息
	public function getGroupList( $pid=0, $is_tree=true)
	{
		$this->__clean();
		$this->__bindQuery("pid", $pid);
		$this->__orderBy("sort");
		$this->__orderBy("group_id"); 
		$data = $this->__list(array());
		if(empty($data)) return "";
			
		if($is_tree)
		{
			for($i=0; $i<sizeof($data); $i++)
			{
				if($data[$i]["group_img"]) $data[$i]["group_img"] = DOMAIN.$data[$i]["group_img"];
				$data[$i]["childs"] = $this->getGroupList($data[$i]["group_id"]);
			}
		}
				
		return $data;
	}
}