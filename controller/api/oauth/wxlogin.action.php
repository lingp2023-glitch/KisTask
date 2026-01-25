<?php
$ticket = $this->in["ticket"];
$modelAccount = init_submodel("account", "account");
$k="wxlogin_{$ticket}";
$openid = $modelAccount->__redisGet($k);
if(!$openid) $this->__exit(0);

$data = $modelAccount->refreshTokenByOpenid($openid);
$data["bind_phone"] = 0;
$account = $modelAccount->__getRow("openid", $openid);
if($account["phone"]) $data["bind_phone"] = 1;

$this->__exit(1, '', $data);