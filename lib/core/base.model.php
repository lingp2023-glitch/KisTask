<?php
abstract class model
{
	protected $pdo;
	protected $redis;
	
	function __construct()
	{	
		$this->pdo="";
		$this->redis="";
	}
	
	function __destruct()
	{	
		closeDB();
		$this->pdo="";
		$this->redis="";
	}
	
	public function connectDB()
	{
		if(!$this->pdo)
			$this->pdo = connectDB();
		return $this->pdo;
	}
	
	public function connectRedis()
	{
		if(!$this->redis)
			$this->redis = connectRedis();
		return $this->redis;
	}
		
	//reids操作函数
  public function __redisDel($k)
  {
	 if(!$this->redis)
		$this->redis=connectRedis();
	  
  	$key = PREFIX_REDIS.$k;
  	$this->redis->del($key);
  }
  
  public function __redisSet($k, $v, $expire=0)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k;
  	$this->redis->set($key, $v);
  	if($expire>0)
		$this->redis->expire($key, $expire);  		
  }
  
  public function __redisGet($k)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	return $this->redis->get(PREFIX_REDIS.$k);
  }
  
  public function __redisLpush($k, $v, $expire=0)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k;
  	$this->redis->lpush($key, $v);
  	if($expire>0)
  		$this->redis->expire($key, $expire);
  }
  
  public function __redisLpop($k)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k;
  	return $this->redis->lpop($key);
  }

  public function __redisLset($k, $index, $v)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k;
  	$this->redis->lset($key, $index, $v);;
  }
  
  public function __redisLLen($k)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k;
  	return $this->redis->llen($key);
  }
  
  public function __redisLIndex($k, $index)
  {
	if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k;
  	return $this->redis->LINDEX($key, $index);
  }
  
  public function __redisList($k)
  {
	 if(!$this->redis)
		$this->redis=connectRedis();
  	$key = PREFIX_REDIS.$k; 
  	$len = $this->redis->llen($key); 
  	if($len ==0) return "";
  	return $this->redis->lrange($key, 0, $len);
  }
	
	public function __redisHSet($k, $f, $v, $expire=0)
	{
		if(!$this->redis)
			$this->redis=connectRedis();
		$key = PREFIX_REDIS.$k;
		$this->redis->hSet($key, $f, $v);
		if($expire>0)
			$this->redis->expire($key, $expire);	
	}

	public function __redisHGet($k, $f)
	{ 
		if(!$this->redis)
			$this->redis=connectRedis();
		return $this->redis->hGet(PREFIX_REDIS.$k, $f);
	}

	public function __redisHDel($k, $f)
	{
		if(!$this->redis)
			$this->redis=connectRedis();
		
		$key = PREFIX_REDIS.$k;
		$this->redis->hdel($key, $f);
	}

	public function __redisHGetAll($k)
	{
		if(!$this->redis)
			$this->redis=connectRedis();
		
		$key = PREFIX_REDIS.$k;
		return $this->redis->hgetall($key);
	}

	//mysql操作函数	
	protected function __clean(){}

	public function __execSql($sql)
	{
		if(GLOBAL_DEBUG) write_log($sql, "sql");
		$this->connectDB();
		$this->pdo->exec($sql);
		$this->__clean();	
	}
	
	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}

	public function __querySql($sql)
	{  
		if(GLOBAL_DEBUG) write_log($sql, "sql");
		$this->connectDB();
		$result = $this->pdo->query($sql); 
		$this->__clean();
		return $result;
	}
}