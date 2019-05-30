<?php
namespace logic\user;
use app\common\Common;
class User{

    public function lists($ids=0,$page=1,$limit=20){
        echo $ids;die;
        $lists = Common::D('user','UserList')->lists($ids,$page,$limit);
        return $lists;
    }

}