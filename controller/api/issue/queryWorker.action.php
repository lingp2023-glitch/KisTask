<?php
$project_id = $this->in["project_id"];
$query_str = (empty($this->in["query_str"]))?"":$this->in["query_str"];

$modelAccount = init_submodel("account", "account");
if($query_str) $modelAccount->__bindQuery("name", $query_str, "like");
$accounts = $modelAccount->__list(["userid, name"]);

$this->__exit(0, '', $accounts);