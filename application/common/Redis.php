<?php
namespace app\common;
use think\Config;

/**
* redis
*/
class Redis
{

	/**
	* $key redis配置的键
     * $str 自定义的字符串
     * return key  返回redis键
	*/
	static public function getkey($key,$str='') {
	    if($str)  return config('redis'.$key).$str;
        return config('redis'.$key);

    }

}

