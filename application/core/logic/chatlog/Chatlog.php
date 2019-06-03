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

}