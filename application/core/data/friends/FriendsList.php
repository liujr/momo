<?php
namespace data\friends;
use app\common\Common;
use think\Db;
class FriendsList{

    public function lists($userid,$page=1,$limit=20){
        if(!$userid) Common::E('非法访问');
        $where['userid'] = $userid;
        $list = Db::name('friends')->where($where)->page($page)->limit($limit)->select();
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
        $list = Db::table('friends')
            ->alias(' f ')
            ->field(' u.userid as id,u.account as username,u.avatar,u.sign,u.is_online as status')
            ->join('me_user u ','f.friendid= u.userid')
            ->where("f.userid='$userid' and f.groupid='$cateid'")->page($page)->limit($limit)->select();
        $total = Db::table('friends')->where("f.userid='$userid' and f.groupid='$cateid'")->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}