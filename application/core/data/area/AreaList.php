<?php
namespace data\area;
use app\common\Common;
use think\Db;
class AreaList{

    public function getlist($param){
        if(!$param['ids']) Common::E('省市区id不存在');
        $where[] =['id','in',$param['ids']];
        $list = Db::name('area')->where($where)->select();
        $total  = Db::name('area')->where($where)->count();
        return [
            'list'=>$list,
            'total' =>$total
        ];
    }

    public function getlistByParentId($parentid){
        if(!$parentid) Common::E('父亲id不存在');
        $where['parent_id'] = $parentid;
        $list = Db::name('area')->where($where)->select();
        $total  = Db::name('area')->where($where)->count();
        return [
            'list'=>$list,
            'total' =>$total
        ];
    }
}