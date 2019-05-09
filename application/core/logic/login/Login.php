<?php
namespace logic\login;
use think\Session;
class Login {
    /*
     * 登录
     */
    public function login($param){
        return ['mobile'=>$param,'userid'=>12,'usename'=>'张三'];
    }


}