<?php
namespace data\user;
use app\common\Common;
use think\Db;

class UserList{
    public function lists($ids,$page=1,$limit=20){
        if($ids) $where[] =['userid','not in',$ids];
        //$where['datastatus'] = 1;
        $list = Db::name('user')->where($where)->page($page)->limit($limit)->order('userid desc')->select();
        echo Db::name('user')->fetchSql();die;
        $total = Db::name('user')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}