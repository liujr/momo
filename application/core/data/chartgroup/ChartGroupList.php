<?php
namespace data\chartgroup;
use app\common\Common;
use think\Db;
class ChartGroupList{
    public function lists($id=0,$owner_id=0,$status=2,$notownerid='',$page=1,$limit=20){
        if($id) $where[] = ['id','=',$id];
        if($owner_id) $where[] = ['owner_id','=',$owner_id];
        if($status) $where[] = ['status','=',$status];
        if($notownerid) $where[] = ['owner_id','not in',$notownerid];
        $list = Db::name('chatgroup')->where($where)->order('id desc')->page($page)->limit($limit)->select();
        $total = Db::name('chatgroup')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }
}