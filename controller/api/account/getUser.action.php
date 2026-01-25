<?php
$user = ["userid"=>$this->user["userid"],
    "phone"=>$this->user["phone"],
    "name"=>$this->user["name"],
    "headimg"=>DOMAIN."runtime/avatar/avatar.png",
    "group_id"=>$this->user["group_id"]];

$modelRole = init_submodel("role", "account");
$role=$modelRole->__getRow("roleid", $this->user["roleid"]);
$user["role_name"] = ($role)?$role["role_name"]:"";

$modelGroup = init_submodel("group", "group");
$group = $modelGroup->__getRow("group_id", $this->user["group_id"]);
if($group) 
    $user["group_name"] = $group["group_name"];

$this->__exit(0, "", $user);