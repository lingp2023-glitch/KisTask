<?php //后台管理系统接口
class api extends Controller
{
	private $user;
	
	protected function __init()
	{
		require_once("controller/".ST."/construct.action.php");				
		if(SUB_ACT)	require_once("controller/".ST."/".ACT."/".SUB_ACT.".action.php");
	}
}