<?php
namespace data\area;
use app\common\Common;
use think\Db;
class AreaList{

    public function getlist($param){

        $where['level'] = 1;
        $list = Db::name('area')->where($where)->select();
        $total  = Db::name('area')->where($where)->count();
        return [
            'list'=>$list,
            'total' =>$total
        ];
    }
}