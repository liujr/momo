<?php
namespace logic\friends;
use app\common\Common;

class Friends{

    public function lists($userid,$page=1,$limit=20){
        if(!$userid) Common::E('非法访问');
        $lists = Common::D('friends','FriendsList')->lists($userid,$page,$limit);
        return $lists;
    }
}