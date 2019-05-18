<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class MenuLists{

    public function lists($param = array()){
        if($param['pid']) $where['pid'] = $param['pid'];
        $where['status'] = 1;
        $info = Db::name('menu')->where($where)->select();
        return $info;
    }
}