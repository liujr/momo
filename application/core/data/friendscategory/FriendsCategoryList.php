<?php
namespace data\friendscategory;
use app\common\Common;
use think\Db;

class FriendsCategoryList{
    public function lists($page=1,$limit=50){
        $list = Db::name('friendscategory')->order('id desc')->page($page)->limit($limit)->select();
        $total = Db::name('friendscategory')->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }
}