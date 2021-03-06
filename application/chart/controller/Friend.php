<?php
namespace app\chart\controller;
use app\common\Common;
class Friend extends Base{


    /**
     * 同意加为好友
     */
    public function agree(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $userid = session('userid');
            $friend_id = input('uid');
            $group_id = input('group');
            $from_group = input('from_group');
            //将我与请求人建立关系
            $obj = new \logic\friends\Friends();
            $obj->add($userid,$friend_id,$group_id);

            //将请求人与我建立关系
            $obj->add($friend_id,$userid,$from_group);

            //入库系统消息
            $content = session('mobile') . ' 已经同意你的好友申请';
            $obj = new \logic\msgbox\Msgbox();
            $res = $obj->add($friend_id,'',$from_group,'-1',2,$content,'');

            //将此消息标记为已经同意
            $obj->agree(input('id'),1);

            Common::show(config('code.success'),'添加成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 通知好友已经同意添加
     * @param $ws
     * @param $fd
     * @param $message
     */
    static  public function noticeFriend($ws,$fd,$message){
        $add_message = [
            'message_type' => 'addFriend',
            'data' => [
                'username' => $message['username'],
                'avatar' => $message['avatar'],
                'id' => $message['id'],
                'type' => 'friend',
                'sign' => $message['sign'],
                'groupid' => $message['groupid'],
                'userid'=>$message['toid'],
            ]
        ];
        $senddata = array(
            'controller' =>'FriendsTask',
            'method'     =>'noticeFriend',
            'data'          =>$add_message,

        );
        $ws->task($senddata);
    }

    public function refuseFriend(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');

            $obj = new \logic\msgbox\Msgbox();
            //将此消息标记为不同意
            $obj->agree(input('id'),2);
            //入库系统消息
            $content = session('mobile') . ' 拒绝了你的好友申请';
            $res = $obj->add( input('uid'),'',0,'-1',2,$content,'');

            Common::show(config('code.success'),'拒绝成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

}