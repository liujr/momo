<?php

namespace task;
use app\common\Redis;
class FriendsTask{

    public function noticeFriend($server,$param){
        echo '<pre>';
        print_r($param);
        $fd = Redis::getInstance()->get(config('redis.userid_association_fd').$param['userid']);
        echo $fd;
        if($fd){
            $server->push($fd, json_encode($param));
        }
    }

}