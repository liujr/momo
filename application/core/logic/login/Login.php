<?php
namespace logic\login;
use app\common\Common;
use app\common\Redis;
class Login {
    /****************************************前端用户登录***************************************************/
    /*
     * 用户手机号码登录
     */
    public function login($mobile){
        if(empty($mobile)) Common::E('电话号码不能为空');
        $data = ['mobile'=>$mobile,'userid'=>0];
        $info = Common::D('login','Login')->getInfo($data);
        $userid = $info['userid'];
        if(!$info){
            $userid = Common::D('login','Login')->add($data);
        }
        //登录 成功之后保存到redis
        Redis::getInstance()->set($mobile,$userid);
        return ['userid'=>$userid];
    }

    /****************************************管理后台用户登录***************************************************/

    public function adminLogin($param){
        if(!$param['account']) Common::E('账号不能为空');
        if(!$param['password']) Common::E('密码不能为空');
        if(!$param['code']) Common::E('验证码不能为空');
        $code = Redis::getInstance()->get(config('config.admin_login_code').$param['account']);
        if($param['code'] !=  $code) Common::E('验证码错误');
        $password =md5(md5($param['password']).$param['account']);
        $info = Common::D('admin','Adminuser')->getInfo(['account'=>$param['account'],'password'=>$password]);
        if(!$info)Common::E("账号/密码错误");
        session(config('config.admin_user_login'),$info['id']);
        return $info['id'];
    }

}