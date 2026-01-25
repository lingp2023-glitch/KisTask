<?php
class accountModel extends tableModel
{
	protected function __init()    
	{ 
		$this->__setTable("sys_account");
	}
	
	//更新用户Token
 	public function refreshToken($userid)
 	{
 		$token = md5($userid.APPKEY.time().mt_rand(1000, 9999));
 		$refresh_token = md5($userid.APPKEY.time().mt_rand(1000, 9999));
 		$expires_in = time()+TOKEN_EXPIRESIN;
 		$exp_time = date("Y-m-d H:i:s", $expires_in);
 		
 		$this->__bind("token", $token);
 		$this->__bind("token_exptime", $exp_time);
 		$this->__bind("refresh_token", $refresh_token);
 		$this->__bind("token_time", showtime());
 		$this->__bindQuery("userid", $userid);
 		$this->__mod();
 		
 		return array("token"=>$token, 
 			"expires_in"=>$expires_in, 
 			"refresh_token"=>$refresh_token);
 	}

	//更新用户Token
	public function refreshTokenByOpenid($openid)
	{
		$token = md5($openid.APPKEY.time().mt_rand(1000, 9999));
		$refresh_token = md5($openid.APPKEY.time().mt_rand(1000, 9999));
		$expires_in = time()+TOKEN_EXPIRESIN;
		$exp_time = date("Y-m-d H:i:s", $expires_in);
		
		$this->__bind("token", $token);
		$this->__bind("token_exptime", $exp_time);
		$this->__bind("refresh_token", $refresh_token);
		$this->__bind("token_time", showtime());
		$this->__bindQuery("openid", $openid);
		$this->__mod();
		
		return array("token"=>$token, 
			"expires_in"=>$expires_in, 
			"refresh_token"=>$refresh_token);
	}
	
	//微信扫码登陆
	public function wxSub($openid)
	{
		$modelGH = init_model("wechatGH");
		$info = $modelGH->getUserInfo($openid);

		$account = $this->__getRow("openid", $openid);
		if(!$account)
		{
			$this->__bind("openid", $openid);
			$this->__bind("is_ghsub", 1);
			$this->__bind("roleid", SYSGRADE_GUEST);
			$this->__bind("create_time", showtime());
			$this->__add();
		}
		elseif(!$account["is_ghsub"])
		{
			$this->__bindQuery("openid", $openid);
			$this->__bind("is_ghsub", 1);
			$this->__mod();
		}
	}

	//取消关注
	public function wxUnsub($openid)
	{
		$this->__bindQuery("openid", $openid);
		$this->__bind("is_ghsub", 0);
		$this->__mod();
	}
}