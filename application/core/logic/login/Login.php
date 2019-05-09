<?php
namespace logic\login;
use app\common\Common;
use think\Session;
class Login {
    /*
     * 手机号码登录
     */
    public function login($mobile){
        if(empty($mobile)) Common::E('电话号码不能为空');
        $data = ['mobile'=>$mobile];
        $info = Common::D('login','Login')->getInfo($data);
        print_r(1111111111);
        /*$userid = $info['userid'];
        if(!$info){
            $userid = Common::D('login','Login')->add($data);
        }
        Session::set('userid',$userid);
        return ['userid'=>$userid];*/
    }


}