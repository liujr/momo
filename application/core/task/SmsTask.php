<?php
namespace task;
use app\common\Common;
use app\common\Redis;
class SmsTask{
    /**
     * 发送登录手机验证码
     */
    public function sendSms($param){
        /*发送手机号
          $data = [
            'key' =>$param['key'],
            'tpl_id' =>$param['tpl_id'],
            'tpl_value' =>$param['tpl_value'],
            'mobile'    => $param['mobile'],
        ];
        $paramstring = http_build_query($data);
        $content = Common::post($param['url'], $paramstring);
        $result = json_decode($content, true);
        */
        $result  = ['error_code'=>0];
		if ($result['error_code'] == 0) {
            Redis::getInstance()->set(config('redis.smskey').$param['mobile'],$param['randnum'],config('redis.sms_out_time'));
            /*异步redis
             * $redis = new \Swoole\Coroutine\Redis();
            $redis->connect(config('redis.host'), config('redis.port'));
            $redis->set(config('redis.smskey').$data['mobile'],$data['randnum'],config('redis.sms_out_time'));*/
		} else {
            Common::E($result['reason']);
		}
    }
}