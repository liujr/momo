<?php
namespace logic\chatlog;
use app\common\Common;
class Chatlog{

    public function lists($toid,$type,$page=1,$limit=20){
        $lists = Common::D('chatlog','ChatlogList')->lists($toid,$type,$page,$limit);
        return $lists;
    }

    public function editNeedSend($id){
        if(!$id) Common::E('非法操作');
        Common::D('chatlog','Chatlog')->editNeedSend($id);
        return true;
    }

    public function add($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type,$need_send){
        $this->checkdata($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type,$need_send);
        $data = $this->getdata($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type,$need_send);
        $res = Common::D('chatlog','Chatlog')->add($data);
        return $res;
    }

    private function checkdata($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type){
        if(!$from_id) Common::E('会话来源id不能为空');
        if(!$from_name) Common::E('消息来源用户名不能为空');
        if(!$from_avatar) Common::E('来源的用户头像不能为空');
        if(!$to_id) Common::E('会话发送的id不能为空');
        if(!$content) Common::E('发送的内容不能为空');
        if(!$time) Common::E('记录时间不能为空');
        if(!$type) Common::E('聊天类型不能为空');
    }

    private function getdata($from_id,$from_name,$from_avatar,$to_id,$content,$time,$type,$need_send){
        $param = [
            'from_id'=>$from_id,
            'from_name'=>$from_name,
            'from_avatar'=>$from_avatar,
            'to_id'=>$to_id,
            'content'=>$content,
            'timeline'=>$time,
            'type'=>$type,
            'need_send'=>$need_send,
        ];
        return $param;
    }

}