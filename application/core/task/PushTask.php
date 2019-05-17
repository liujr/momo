<?php
namespace task;
use app\common\Common;
use app\common\Redis;
class PushTask{
    /**
     * 发送登录手机验证码
     */
    public function push($server,$param){
        $res = Redis::getInstance()->sMembers(config('redis.online_key'));
        foreach ($res as $k=>$v){
            $server->push($v, json_encode($param));
        }
    }
}