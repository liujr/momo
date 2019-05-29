<?php
namespace app\chart\controller;

class User extends Base{

    public function info(){
        $obj = new \logic\login\UserLogin();
        $user = $obj->info(session('userid'));
        $this->assign(get_defined_vars());
        return $this->fetch();
    }



}