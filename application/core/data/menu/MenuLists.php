<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class MenuLists{

    public function lists($param = array()){
        if($param['pid']) $where['pid'] = $param['pid'];
        $where['status'] = 1;
        $field = '*';
        $info = Db::name('menu')->field($field)->where($where)->select();
        return $info;
    }
}