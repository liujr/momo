<?php

namespace app\home\controller;

use \think\Controller;
use app\common\Common;
use app\common\Redis;
class Login extends Controller{

    /**
     * 登录页面
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }

    public function getcode(){
        try{
            $account = input('account');
            echo config('config.admin_login').$account;die;
            if(!$account) Common::E('用户名不能为空');
            $randnum = Common::randnum(4,1);//随机获取4位数
            Redis::getInstance()->set(config('config.admin_login').$account,$randnum,config('config.admin_login_out'));
            return Common::show(config('code.success'),'发送成功',['code'=>$randnum]);
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}