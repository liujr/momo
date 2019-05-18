<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class MenuLists{

    public function lists(){
        $where['status'] = 1;
        $field = 'menuurl as href,menuname as title';
        $info = Db::name('menu')->field($field)->where($where)->select();
        return $info;
    }
}