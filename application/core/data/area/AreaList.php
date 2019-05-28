<?php
namespace data\area;
use app\common\Common;
use think\Db;
class AreaList{

    public function getlist($param){

        $where['id'] =['in',$param['ids']];
        $list = Db::name('area')->where($where)->select();
        $total  = Db::name('area')->where($where)->count();
        return [
            'list'=>$list,
            'total' =>$total
        ];
    }
}