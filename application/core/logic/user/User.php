<?php
namespace logic\user;
use app\common\Common;
class User{

    public function lists($ids=0,$page=1,$limit=20){
        $lists = Common::D('user','UserList')->lists($ids,$page,$limit);
        return $lists;
    }

    public function info($userid){
        $info = Common::D('user','User')->info(['userid'=>$userid,'mobile'=>0]);
        return $info;
    }

}