<?php
namespace app\chart\controller;
use app\common\Redis;
class Login extends Base{

    /**
     * 登录页面
     */
     public function index(){
         return $this->fetch();
    }

    /**
     * 注册页面
     */
    public function register(){
        return $this->fetch();
    }





}