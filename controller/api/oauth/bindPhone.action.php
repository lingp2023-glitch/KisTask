<?php
$phone = $this->in["phone"];
$password = $this->in["password"];
$code = $this->in["code"];

//验证手机
$modelSms = init_submodel("sms", "user");
$result = $modelSms->checkSmsCode($phone, $code);
if($result["code"] != 200) $this->__exit(-1, $result["msg"]);

$modelStaff = init_submodel("staff", "shop");
$staff = $modelStaff->__getRow("phone", $phone);
$roleid = SYSGRADE_GUEST;
if($staff)
    $roleid = ($staff["roleid"]==1)?SYSGRADE_MANAGER:SYSGRADE_STAFF;

$rand_code = mt_rand(1000, 9999);
$password = md5($rand_code.$password);

$modelAccount = init_submodel("account", "account");
$modelAccount->__bind("rand_code", $rand_code);
$modelAccount->__bind("password", $password);
$modelAccount->__bind("phone", $phone);
$modelAccount->__bind("roleid", $roleid);
$modelAccount->__bind("brand_id", $staff["brand_id"]);
$modelAccount->__bindQuery("userid", $this->user["userid"]);
$modelAccount->__mod();

$this->__exit(0);	