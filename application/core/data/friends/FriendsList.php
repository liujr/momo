<?php
namespace data\friends;
use app\common\Common;
use think\Db;
class FriendsList{

    public function lists($userid=0,$page=1,$limit=20,$friendid=0){
        echo $userid;
        if(!$userid)  $where['userid'] = $userid;
        if(!$friendid)  $where['friendid'] = $friendid;
        $list = Db::name('friends')->where($where)->page($page)->limit($limit)->select();
        echo Db::name('friends')->buildSql();
        $total = Db::name('friends')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

    public function getFriendsByCateId($userid,$cateid,$page=1,$limit=20){
        if(!$userid) Common::E('非法访问');
        if(!$cateid) Common::E('分类id不存在');
        $list = Db::table('me_friends')
            ->alias(' f ')
            ->field(' u.userid as id,u.account as username,u.avatar,u.sign,u.is_online as status')
            ->join('me_user u ','f.friendid= u.userid')
            ->where("f.userid='$userid' and f.groupid='$cateid'")->page($page)->limit($limit)->select();
        $total = Db::table('me_friends')->alias('f')->where("f.userid='$userid' and f.groupid='$cateid'")->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}