<?php
namespace app\chart\controller;
use app\common\Redis;
class Init extends Base{

    static public function index($ws,$fd,$data){
        session('chart_mobile',$data['mobile']); //用户名
        session('chart_avatar',$data['avatar']); //头像
        session('chart_id',$data['id']); //用户id
        session('chart_sign',$data['sign']); // 签名

        //将当前用户跟fd绑定
        Redis::getInstance()->set(config('redis.userid_association_fd').$data['id'],$fd);

        //查询有无需要推送的离线信息
        $chatlogObj = new \logic\chatlog\Chatlog();
        $resMsg = $chatlogObj->lists($data['id'],'friend',$page=1,$limit=999);
        if($resMsg['lists']){
            foreach ($resMsg['lists'] as $k=>$vo){
                $log_message = [
                    'message_type' => 'logMessage',
                    'data' => [
                        'username' => $vo['from_name'],
                        'avatar' => $vo['from_avatar'],
                        'id' => $vo['from_id'],
                        'type' => 'friend',
                        'content' => htmlspecialchars($vo['content']),
                        'timestamp' => $vo['timeline'] * 1000,
                    ]
                ];
                $senddata = array(
                    'controller' =>'InitTask',
                    'method'     =>'pushChartLog',
                    'data'          =>$log_message
                );
                $ws->task($senddata);

                $chatlogObj->editNeedSend($vo['id']);
            }
        }

        // 通知所有该用户好友，此用户上线，将此用户头像变亮
        $friendsObj = new \logic\friends\Friends();
        $friends = $friendsObj->lists(0,$page=1,$limit=999,$data['id']);
        if($friends['lists']){
            foreach ($friends['lists'] as $kk=>$vv){
                $online_message = [
                    'message_type' => 'online',
                    'id' => $data['id'],
                    'userid'=>$vv['userid']
                ];
                $senddata2 = array(
                    'controller' =>'InitTask',
                    'method'     =>'pushFriends',
                    'data'          =>$online_message
                );
                $ws->task($senddata2);
            }
        }

    }





}