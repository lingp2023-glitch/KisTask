<?php
//微信接口支付
require_once 'vendor/autoload.php';	
use GuzzleHttp\Exception\RequestException;
use WechatPay\GuzzleMiddleware\WechatPayMiddleware;
use WechatPay\GuzzleMiddleware\Util\PemUtil;
use GuzzleHttp\HandlerStack;

class test extends Controller{
	function __construct(){
		parent::__construct();
	}

	public function finish()
	{
		$this->__exit(0);	
	}
}
