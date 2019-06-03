<?php

namespace task;
use app\common\Redis;
class FriendsTask{

    public function noticeFriend($server,$param){
        $fd = Redis::getInstance()->get(config('redis.userid_association_fd').$param['data']['userid']);
        if($fd){
            $server->push($fd, json_encode($param));
        }
    }

}