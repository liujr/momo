<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class MenuLists{

    public function lists(){
        $where['status'] = 1;
        $info = Db::name('menu')->where($where)->select();
        return $info;
    }
}