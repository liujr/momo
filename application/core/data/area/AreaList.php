<?php
namespace data\area;
use app\common\Common;
use think\Db;
class AreaList{

    public function getlist($param){
        $where = [];
        if($param['ids']) $where = array_merage($where, ['id', 'in', $param['ids'] ]);
        $list = Db::name('area')->where($where)->select();
        echo Db::name('area')->fetchSql();die;
        $total = Db::name('area')->where($where)->count();
        return [
            'list' =>$list,
            'total' =>$total
        ];
    }
}