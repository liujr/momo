<?php
namespace data\area;
use app\common\Common;
use think\Db;
class AreaList{

    public function getlist($param){
        if($param['ids']) $where['id'] = array('in',$param['ids']);
        echo '<pre>';
        print_r($where);die;
        $list = Db::name('area')->where($where)->select();
        echo Db::name('area')->fetchSql();die;
        $total = Db::name('area')->where($where)->count();
        return [
            'list' =>$list,
            'total' =>$total
        ];
    }
}