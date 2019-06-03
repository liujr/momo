<?php
namespace logic\friends;
use app\common\Common;

class Friends{

    public function lists($userid=0,$page=1,$limit=20,$friendid=0){
        $lists = Common::D('friends','FriendsList')->lists($userid,$page,$limit,$friendid);
        return $lists;
    }

    /**
     * 根据分类id和用户id获取朋友列表
     */
    public function getFriendsByCateId($userid,$cateid,$page=1,$limit=20){
        if(!$userid) Common::E('非法访问');
        if(!$cateid) Common::E('分类id不存在');
        $lists = Common::D('friends','FriendsList')->getFriendsByCateId($userid,$cateid,$page,$limit);
        return $lists;
    }
}