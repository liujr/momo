<?php
namespace data\area;
use app\common\Common;
use think\Db;
class AreaList{

    public function getlist($param){
        if($param['ids']) $where['id'] =110100;
        $list = Db::name('area')->where($where)->select();
        echo Db::name('area')->fetchSql();die;
        $total = Db::name('area')->where($where)->count();
        return [
            'list' =>$list,
            'total' =>$total
        ];
    }
}