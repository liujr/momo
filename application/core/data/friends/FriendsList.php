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

}