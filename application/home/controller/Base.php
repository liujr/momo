<?php


namespace app\home\controller;
use \think\Controller;

class Base extends Controller{


    public function initialize(){
        $res = cookie(config('config.admin_user_login'));
        if(!$res) $this->redirect('/home/login/index');
    }

}