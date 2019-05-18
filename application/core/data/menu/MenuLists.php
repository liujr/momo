<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class MenuLists{

    public function lists(){
        $where['status'] = 1;
        $list = Db::name('menu')->where($where)->select();
        return $list;
    }

    public function listsBypid(){
        $where['status'] = 1;
        $where['pid'] = 0;
        $list = Db::name('menu')->where($where)->select();
        $total  = Db::name('menu')->where($where)->count();
        return [
            'list'=>$list,
            'total' =>$total
        ];

    }
}