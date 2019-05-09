<?php
namespace app\index\controller;
use app\common\Redis;
use think\Exception;
use app\common\Common;
class Login
{
    /**
     * 发送短信
     */
    public function index(){
        try{
            $code = $_GET['code'];
            $mobile = intval($_GET['mobile']);
            if(empty($code) ||  empty($mobile)) Common::E('电话号码或验证码不能为空');
            $redisCode = Redis::getInstance()->get(config('redis.smskey').$mobile);
            if($redisCode != $code) Common::E('验证码错误或超时');
            $LoginObj = new \logic\login\Login();
            $data = $LoginObj->login($mobile);

            return Common::show(config('code.success'),'登录成功',$data);
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
