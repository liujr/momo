<?php

namespace app\chart\controller;
use app\common\Common;
use app\common\Redis;
class Chart extends Base{

    static public function chart($ws,$fd,$message){

        // 聊天消息
        $type = $message['data']['to']['type'];
        $to_id = $message['data']['to']['id'];
        $uid = $message['data']['mine']['id'];

        $chat_message = [
            'message_type' => 'chatMessage',
            'data' => [
                'username' => $message['data']['mine']['username'],
                'avatar' => $message['data']['mine']['avatar'],
                'id' => $type === 'friend' ? $uid : $to_id,
                'type' => $type,
                'content' => htmlspecialchars($message['data']['mine']['content']),
                'timestamp' => time() * 1000,
            ]
        ];

        // 加入聊天log表
        $from_id = $uid;
        $from_name = $message['data']['mine']['username'];
        $from_avatar = $message['data']['mine']['avatar'];
        $to_id = $to_id;
        $content = htmlspecialchars($message['data']['mine']['content']);
        $time = time();
        $need_send = 0;

        $chatlogObj = new \logic\chatlog\Chatlog();

        switch ($type) {
            // 私聊
            case 'friend':
                // 插入
                $type = 'friend';
                if (empty(Redis::getInstance()->get(config('redis.userid_association_fd').$to_id))) {
                    $need_send = 1;  //用户不在线,标记此消息推送
                }

                $chatlogObj->add($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type,$need_send);
                $ws->push($to_id, json_encode($chat_message));
                return;
            // 群聊
            case 'group':
                $type = 'group';
                $chatlogObj->add($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type,$need_send);
               // return Gateway::sendToGroup($to_id, json_encode($chat_message), $client_id);
        }

    }

}