<?php
namespace logic\blacktab;
use app\common\Common;
class Blacktab{

    public function info($user_id,$put_uid){
        if(!$user_id) Common::E('操作人的id不能为空');
        if(!$put_uid) Common::E('被加入黑名单的id不能为空');
        $lists = Common::D('blacktab','Blacktab')->info($user_id,$put_uid);
        if(!empty($lists)) Common::E('对方已将你加入黑名单');
        return true;

    }
}