<?php
namespace data\groupdetail;
use app\common\Common;
use think\Db;

class GroupdetailList{

    public function lists($userid=0,$page=1,$limit=20){
        $where[]=['gd.user_id','=',$userid];
        $list = Db::table('me_groupdetail')
            ->alias(' gd ')
            ->field('gd.*,g.group_name as groupname,g.avatar,g.id')
            ->join('me_chatgroup g ','gd.group_id= g.id')
            ->where($where)->page($page)->limit($limit)->select();
        $total = Db::table('me_groupdetail')->alias('gd')->join('me_chatgroup g ','gd.group_id= g.id')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

    public function getlistsBygroupid($groupid=0,$page=1,$limit=20){
        $where[]=['gd.group_id','=',$groupid];
        $list = Db::table('me_groupdetail')
            ->alias(' gd ')
            ->field('gd.*,u.userid as id,u.account as username,u.avatar,u.sign')
            ->join('me_user u ','gd.user_id= u.userid')
            ->where($where)->page($page)->limit($limit)->select();
        $total = Db::table('me_groupdetail')->alias('gd')->join('me_user u ','gd.user_id= u.userid')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}