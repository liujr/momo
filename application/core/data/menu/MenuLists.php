<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class MenuLists{

    public function lists(){
        $where['status'] = 1;
        $field = '*';
        $info = Db::name('menu')->field($field)->where($where)->select();
        return $info;
    }
}