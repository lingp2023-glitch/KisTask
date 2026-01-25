<?php
class project extends Controller
{	
	public function create()
	{
		$cfg = empty($this->in["config"])?"api":$this->in["config"];
		include('config/api_'.$cfg.'.php');
		$apis = json_decode(API_DEF, true);
		$text="\xEF\xBB\xBF<?php\n";
		$text.= "\$this->__exit(0, 'api request ok');";

		foreach($apis as $m)
		{
			foreach($m["functions"] as $f)
			{	
				$fname = CONTROLLER_DIR.$f["api"].".action.php"; 
				if(file_exists($fname)) continue;
				$fp = fopen($fname, "w+");
				fwrite($fp, $text);
				fclose($fp);
			}
		}

		$this->__exit(0, "create finish");
	}

	public function list()
	{
		$cfg = empty($this->in["config"])?"api":$this->in["config"];  
		include('config/api_'.$cfg.'.php');		
		$apis = json_decode(API_DEF, true); 
		$data =["domain"=>DOMAIN, "timestamp"=>TIMESTAMP, "sign"=>SIGN, "apis"=>$apis];
		$this->__exit(0, "", $data);
	}
}
