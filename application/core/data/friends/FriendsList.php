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
        $where[] =['f.userid','=',$userid];
        $where[] =['f.groupid','=',$cateid];
        $list = Db::name('friends')
            ->alias('f')
            ->field(' u.userid as id,u.account as username,u.avatar,u.sign,u.is_online as status')
            ->join('me_user u ','f.friendid= u.userid')
            ->where($where)->page($page)->limit($limit)->buildSql();
        echo $list;die;
        $total = Db::name('friends')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}