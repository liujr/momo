<?php
namespace data\chatlog;
use app\common\Common;
use think\Db;
class Chatlog{

    public function editNeedSend($id){
        if(!$id) Common::E('非法操作');
        $where[] = ['id','=',$id];
        return Db::name('chatlog')->where($where)->update(['need_send'=>0]);
    }

}