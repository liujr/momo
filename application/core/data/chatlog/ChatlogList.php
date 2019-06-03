<?php
namespace data\chatlog;
use app\common\Common;
use think\Db;

class ChatlogList{

    public function lists($toid,$type,$page=1,$limit=20){
        if(!$toid)  Common::E('会话发送的id');
        if(!$type) Common::E('聊天类型不能为空');
        $where[] = ['to_id','=',$toid];
        $where[] = ['type','=',$type];
        $where[] = ['need_send','=',1];
        $list = Db::name('chatlog')->where($where)->order('id desc')->page($page)->limit($limit)->select();
        $total = Db::name('chatlog')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }
}