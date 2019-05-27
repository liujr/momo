<?php

namespace app\home\controller;

use \think\Controller;
use app\common\Common;
use app\common\Redis;
use app\common\Captcha;
class Login extends Controller{

    /**
     * 登录页面
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * 获取验证码
     */
    public function getcode(){
        try{
            $account = input('account');
            if(!$account) Common::E('用户名不能为空');
            $randnum = Common::randnum(4,0);//随机获取4位数
            Redis::getInstance()->set(config('config.admin_login_code').$account,$randnum,config('config.admin_login_out'));
            return Common::show(config('code.success'),'发送成功',['code'=>$randnum]);
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }
    }

    public function login(){
        try{
            $data = [
                'account' => input('account'),
                'password' => input('password'),
                'code'  =>input('code'),
            ];
            $LoginObj = new \logic\login\Login();
            $res = $LoginObj->adminLogin($data);
            return Common::show(config('code.success'),'登录成功',$res);
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }
    }

    public function loginout(){
        cookie(config('config.admin_user_login'),null);
        cookie('admin_user_name',null);
        $this->error('退出成功','/home/login/index');
    }

    public function getcodes(){
        $obj = new Captcha();
        $res = $obj->entry();
        echo $res;
    }
}