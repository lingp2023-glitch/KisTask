<?php
$page = empty($this->in["page"])?1:$this->in["page"];
$model = init_submodel("account", "account");
$model->__join("sys_role");
$model->__joinQuery("sys_account.roleid", "sys_role.roleid ");
$fds = ["sys_role.role_name", "sys_account.userid, sys_account.roleid, sys_account.phone, sys_account.name, sys_account.headimg, sys_account.group_id"];
$data = $model->__pageList($page, $fds);

$modelGroup = init_submodel("group", "group");

for($i=0; $i<$data["num"]; $i++)
{
    if($data["list"][$i]["headimg"])
        $data["list"][$i]["headimg"] = DOMAIN.$data["list"][$i]["headimg"];
    
    $data["list"][$i]["group_name"] = "";
    $group = $modelGroup->__getRow("group_id", $data["list"][$i]["group_id"]);
    if($group) 
        $data["list"][$i]["group_name"] = $group["group_name"];
}


$this->__exit(0, "", $data);