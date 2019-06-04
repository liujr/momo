<?php
namespace data\groupdetail;
use app\common\Common;
use think\Db;

class GroupdetailList{

    public function lists($userid=0,$page=1,$limit=20){
        $list = Db::table('me_groupdetail')
            ->alias(' gd ')
            ->field('gd.*,g.group_name as groupname,g.avatar,g.id')
            ->join('me_chatgroup g ','gd.group_id= g.id')
            ->where("gd.user_id='$userid''")->page($page)->limit($limit)->select();
        $total = Db::table('me_friends')->alias('gd')->where("gd.user_id='$userid'")->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}