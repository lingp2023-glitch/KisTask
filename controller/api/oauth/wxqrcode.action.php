<?php
$modelGh = init_model("wechatGH");
$ticket = $modelGh->getQrTicket("wxlogin");
if(!$ticket) $this->__exit(-1);

$url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket={$ticket}";
$data =["ticket"=>$ticket, "qrurl"=>$url];

$this->__exit(0, '', $data);