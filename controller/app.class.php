<?php
class app extends Controller
{	
	protected function __init()
	{
		$this->tpl  = TEMPLATE;		
	}

	public function index()
	{	
		$this->display("index.html");
	}
}