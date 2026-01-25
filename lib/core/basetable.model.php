<?php
//数据类型
define('DB_FIELD_STR', 1);
define('DB_FIELD_NUM', 2);
define('DB_FIELD_VALUE', 3);
define('DB_FIELD_BIN', 4);

//检查是否是整数
define('CHECK_VALUE_NOTNULL', 1);
function check_1($v){	return !empty($v);}

//检查是否是整数
define('CHECK_VALUE_NUMBER', 2);	
function check_2($v){	return preg_match("/^\d*$/",$v);}

//检查是否是数字
define('CHECK_VALUE_NUMERIC', 3);
function check_3($v){	return is_numeric($v);}

//检查是否合格的手机号
define('CHECK_VALUE_MOBILE', 4); 
function check_4($v){	return preg_match("/^1[34578]\d{9}$/", $v);}

//检查数值
function checkValue($chs, $v)
{
	foreach($chs as $ch)
	{
		if(!call_user_func("check_".$ch, $v))
			return false;
	}
	
	return true;
}

class tableModel extends model
{
	protected $tb;
	protected $param_set;
	protected $query_str;
	protected $order_str;
	protected $total_count;
	protected $page_count;
	protected $page_size;
	protected $page;
	   
	function __construct()
	{ 
		parent::__construct(); 
		$this->tb=""; 
		$this->query_str=""; 
		$this->order_str="";
		$this->group_str="";
		$this->param_set=array();
		
		$this->total_count=0;	
		$this->page_count=0;
		$this->page_size=20;

		$this->__init();
	}
	
	protected function __init(){}		
	public function __setTable($tb){$this->tb=$tb;}		
	public function __table(){return $this->tb;}	
	public function __setPageSize($page_size){$this->page_size=$page_size;}
	protected function __clean()
	{
		$this->param_set=array(); 
		$this->query_str=""; 
		$this->order_str=""; 
		$this->group_str="";
	}
	
	public function __bind($k, $v, $len=0, $field_type=DB_FIELD_STR, $chs=array(), $add_slashes=true, $filt_emoj=true)
	{ 
		$v = $v?trim($v):$v;
		if($filt_emoj) $v = filterEmoji($v);
		if($len) $v = substr($v, 0, $len);
		if($add_slashes) $v=add_slashes($v); //增加转义符
		if(!checkValue($chs, $v)) return false;
		
		$this->param_set[sizeof($this->param_set)] = array("key"=>$k, "value"=>$v, "field_type"=>$field_type);
		return true;
	}

	public function __bindQuery($k, $v, $cmp="=", $link="and", $is_string=true, $chs=array())
	{	
		$v = $v?trim($v):$v;
		if($is_string) $v = add_slashes($v);
		if(!checkValue($chs, $v)) return false;
		
		if($link) //连接符不为空格
			$this->query_str .= empty($this->query_str)?" where ":" ".$link." ";		
		
		if($cmp == "like")
			$this->query_str .= " ".$k." like '%".$v."%' ";	
		elseif($cmp == "in")
			$this->query_str .= " ".$k." ".$cmp." (".$v.") ";
		elseif($cmp == "not in")
			$this->query_str .= " ".$k." ".$cmp." (".$v.") ";
		else
		{
			if($is_string)
				$this->query_str .= " ".$k." ".$cmp." '".$v."' ";
			else
			 	$this->query_str .= " ".$k." ".$cmp." ".$v." ";
		}
	}

	public function __bindPL($link="and") //查询条件左括号
	{
		$this->query_str .= empty($this->query_str)?" where ":" ".$link." ";
		$this->query_str .= " ( ";
	}

	public function __bindPR() //查询条件右括号
	{
		$this->query_str .= " ) ";
	}
	
	//表连接
	public function __join($tb)
	{
		$this->tb .= ",";
		$this->tb .= $tb;
	}
	
	public function __joinQuery($k, $v, $cmp="=", $link="and")
	{	
		$v = $v?trim($v):$v;
		$v = add_slashes($v);
		$this->query_str .= empty($this->query_str)?" where ":" ".$link." ";
		
		if($cmp == "in")
			$this->query_str .= " ".$k." in (".$v.") ";
		elseif($cmp == "not in")
			$this->query_str .= " ".$k." ".$cmp." (".$v.") ";
		else
			$this->query_str .= " ".$k." ".$cmp.$v."";
	}

	public function __groupBy($group)
	{
		$this->group_str .= empty($this->group_str)?" group by ":",";
		$this->group_str .= $group." ";		
	}

	public function __orderBy($order)
	{
		$this->order_str .= empty($this->order_str)?" order by ":",";
		$this->order_str .= $order." ";		
	}

	public function __add()
	{
		$ks="";
		$vs="";
		foreach($this->param_set as $s)
		{
			if(!empty($ks)) 
			{
				$ks .= ",";
				$vs .= ",";
			}

			$ks .= $s["key"];

			if($s["field_type"]==DB_FIELD_BIN)
				$vs .= "0x".$s["value"];
			else
				$vs .= "'".$s["value"]."'";
			//$ks .= key($s);
			//$vs .= "'".current($s)."'";
		}
		$sql = "insert into ".$this->tb." (".$ks.") values (".$vs.")";
		$this->__execSql($sql);
		return $this->lastInsertId();
	}
	
	public function __replace()
	{
		$ks="";
		$vs="";
		foreach($this->param_set as $s)
		{
			if(!empty($ks)) $ks .= ",";
			$ks .= $s["key"];
			
			if(!empty($vs)) $vs .= ",";
			if($s["field_type"]==DB_FIELD_BIN)
				$vs .= "0x".$s["value"];
			else
				$vs .= "'".$s["value"]."'";
		}
		$sql = "REPLACE INTO ".$this->tb." (".$ks.") values (".$vs.")";
		$this->__execSql($sql);
	}

	public function __mod()
	{
		$sql ="";
		foreach($this->param_set as $s)
		{
			if(empty($sql))
				$sql .= "update ".$this->tb." set ";
			else
				$sql .= ",";
			
			$sql .= $s["key"]."=";
			
			if($s["field_type"]==DB_FIELD_VALUE)
				$sql .= $s["value"];
			else if($s["field_type"]==DB_FIELD_BIN)
				$sql .= "0x".$s["value"];
			else
				$sql .= "'".$s["value"]."'";
		}
			
		$sql .= $this->query_str;
		$this->__execSql($sql);
	}
	
	public function __del()
	{
		$sql = "delete from ".$this->tb.$this->query_str;
		$this->__execSql($sql);
	}
	
	public function __getRow($k="", $v="", $fileds=array())
	{
		$fds = "";		
		if(empty($fileds)) 
			$fds = "*";
		else
		{
			foreach($fileds as $fd)
			{
				if(!empty($fds)) $fds .= ",";
				$fds .= $fd;
			}
		}

		$sql = "select ".$fds." from ".$this->tb;
		if(!empty($this->query_str)) 
			$sql .= $this->query_str;
		
		if($k)
		{
			$sql .= (empty($this->query_str))?" where ": " and ";
			$sql .=  $k."='".add_slashes($v)."'";
		}
		
		if(!empty($this->order_str)) $sql .= $this->order_str;		
		$result = $this->__querySql($sql);
		foreach($result as $key=>$item)
			return $this->__getItem($item);
		return "";
	}
	
	protected function __getItem($item)
	{
		$i=0;
		$arr = array();
		foreach($item as $key => $value)
		{			
			if($i==0) $arr[$key]=$value;
			
			$i++;
			if($i==2) $i=0;				
		}
		return $arr;
	}
	
	public function __count()
	{
		$sql = "select count(*) cnt from ".$this->tb;
		if(!empty($this->query_str)) $sql .= $this->query_str;
		$result = $this->__querySql($sql);
		foreach($result as $item)	
			return $item["cnt"];
		return 0;
	}
	
	public function __min($fd)
	{
		$sql = "select min(".$fd.") _minfd from ".$this->tb;
		if(!empty($this->query_str)) $sql .= $this->query_str;
		$result = $this->__querySql($sql);
		foreach($result as $item)	
			return $item["_minfd"];
		return 0;
	}

	public function __max($fd)
	{
		$sql = "select max(".$fd.") _maxfd from ".$this->tb;
		if(!empty($this->query_str)) $sql .= $this->query_str;
		$result = $this->__querySql($sql);
		foreach($result as $item)	
			return $item["_maxfd"];
		return 0;
	}
		
	public function __list($fileds=array(), $limit_num=0)
	{	
		$fds = "";
		if($fileds)
		{
			foreach($fileds as $fd)
			{
				if(!empty($fds)) $fds .= ",";
				$fds .= $fd;
			}
		}
		if(empty($fds)) $fds = "*";
			
		$list = array();
		$sql = "select ".$fds." from ".$this->tb;
		
		if(!empty($this->query_str)) $sql .= $this->query_str;
		if(!empty($this->group_str)) $sql .= $this->group_str;		
		if(!empty($this->order_str)) $sql .= $this->order_str;
		if(!empty($limit_num)) $sql .= " limit 0, ".$limit_num;
		$result = $this->__querySql($sql);
		foreach($result as $key=>$item)
			$list[$key] = $this->__getItem($item);
		
		return $list;
	}

	protected function __calcPage($sub_sql, $count_querys="")
	{
		$sql = "select count(*) total_count ";
		if($count_querys)
			$sql = "select count({$count_querys}) total_count ";
		
		$sql .=$sub_sql;
		$result = $this->__querySql($sql);
		foreach($result as $row)
			$this->total_count = $row["total_count"];
		if($this->total_count>0)
			$this->page_count = (int)(($this->total_count-1)/$this->page_size)+1;
	}
	
	protected function __getLimitSql(&$page)
	{		
		if($page>$this->page_count) $page = $this->page_count;
		if($page < 1) $page = 1;
		$begin = ($page-1) * $this->page_size;
		
		$this->page=$page;
		return " limit ".$begin.",".$this->page_size;
	}
	
	protected function __getPageData($list)
	{
		return array("total_count"=>(int)$this->total_count, //总记录数
			"page_count"=>(int)$this->page_count, //总页数
			"page_size"=>(int)$this->page_size, //每页记录数
			"page"=>(int)$this->page,	//当前页码
			"num"=>sizeof($list),	//当前记录数
			"list"=>$list); //数据集
	}
	
	public function __pageList($page, $fileds=array(), $count_querys="")
	{	
		$fds = "";
		if(empty($fileds)) 
			$fds = "*";
		else 
		{
		 	foreach($fileds as $fd)
			{
				if(!empty($fds)) $fds .= ",";
				$fds .= $fd;
			}
		}
				
		$list = array();
		$sub_sql = " from ".$this->tb;
		if(!empty($this->query_str)) $sub_sql .= $this->query_str;
		if(!empty($this->group_str)) $sub_sql .= $this->group_str; 
		$this->__calcPage($sub_sql, $count_querys);
		if($this->total_count==0) return $this->__getPageData([]);;

		if(!empty($this->order_str)) $sub_sql .= $this->order_str; 
		$limit_sql = $this->__getLimitSql($page);		
		$sql = "select ".$fds.$sub_sql.$limit_sql;
		$result = $this->__querySql($sql);
		foreach($result as $key=>$item)
			$list[$key] = $this->__getItem($item);
			
		return $this->__getPageData($list);
	}
}