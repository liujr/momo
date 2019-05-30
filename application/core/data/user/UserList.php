<?php
namespace data\user;
use app\common\Common;
use think\Db;

class UserList{
    public function lists($ids,$page=1,$limit=20,$mobile=0,$sex=0,$age=0,$pid=0,$cid=0,$aid=0){
        if($ids) $where[] =['userid','not in',$ids];
        if($mobile) $where[] =['mobile','=',$mobile];
        if($sex) $where[] =['sex','=',$sex];
        if($age) $where[] =['age','=',$age];
        if($pid) $where[] =['pid','=',$pid];
        if($cid) $where[] =['cid','=',$cid];
        if($aid) $where[] =['aid','=',$aid];
        $where[] = ['datastatus','=',1];
        $list = Db::name('user')->where($where)->page($page)->limit($limit)->order('userid desc')->select();
        $total = Db::name('user')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

}