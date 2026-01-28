<?php
class app extends Controller
{	
	protected function __init()
	{
		$this->tpl  = TEMPLATE;		
	}

	public function index()
	{	
		if(agent_is_mobile())
			$this->display("mindex.html");
		else
			$this->display("index.html");
	}
}