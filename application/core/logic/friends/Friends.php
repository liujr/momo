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

    public function add($userid,$friend_id,$group_id){
        if(!$userid) Common::E('用户id不存在');
        if(!$friend_id) Common::E('朋友id不存在');
        if(!$group_id) Common::E('分类id不存在');
        $res = Common::D('friends','Friends')->add($userid,$friend_id,$group_id);
        return $res;

    }
}