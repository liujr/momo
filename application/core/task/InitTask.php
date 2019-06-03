<?php

namespace task;

use app\common\Redis;
class InitTask{

    /**
     * 发送离线消息
     * @param $server
     * @param $param
     */
    public function pushChartLog($server,$param){
        $fd = Redis::getInstance()->get(config('redis.userid_association_fd').$param['data']['userid']);
        $server->push($fd, json_encode($param));
    }

    /**
     * 通知好友我已经上线
     * @param $server
     * @param $param
     */
    public function pushFriends($server,$param){
        $fd = Redis::getInstance()->get(config('redis.userid_association_fd').$param['userid']);
        if($fd){
            $server->push($fd, json_encode($param));
        }
    }

}