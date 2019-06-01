<?php
namespace data\msgbox;
use app\common\Common;
use think\Db;
class MsgboxList{

    public function lists($uid,$page=1,$limit=5){
        $where['uid'] = $uid;
        $list = Db::name('message')->where($where)->order('id desc')->page($page)->limit($limit)->select();
        $total = Db::name('message')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'pages'=>$total /$list,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}