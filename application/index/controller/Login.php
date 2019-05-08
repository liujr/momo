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
            return Common::show(config('code.success'),'发送成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
