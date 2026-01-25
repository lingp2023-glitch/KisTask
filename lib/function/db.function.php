<?php
//连接数据库
static $dbh = "";
static $dbhCount = 0;
function connectDB()
{
	global $dbh, $dbhCount;
	if($dbh) 
	{
		$dbhCount++;		 
		return $dbh;
	}
    
	try 
	{
      $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8mb4"));
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      $dbhCount++;
	} catch (PDOException $e) { 	
  	write_log($e->getMessage(), "default", "error");
    die();
	}

	return $dbh;
}

function closeDB()
{
	global $dbh, $dbhCount;
	if($dbhCount==0) return;
	$dbhCount--;
	if($dbhCount==0) $dbh = "";
}

//连接redis
function connectRedis(){
    $redis = "";
    try {
        $redis = new Redis();
        $redis->connect(REDIS_HOST, REDIS_PORT);
        if(!$redis->auth(REDIS_PASS)){
            write_log("redis 连接密码错误","default", "error");
            die();
        }
    }catch (RedisException $e){
        write_log("redis 连接失败", "default", "error");
        die();
    }
    return $redis;
}