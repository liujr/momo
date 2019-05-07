<?php
namespace app\index\controller;
use app\common\Sms;
use think\Exception;
use app\common\Common;
class Send
{
    /**
     * 发送短信
     */
    public function index(){
        try{
            $obj = new Sms(1);
            $param = array(
                'mobile'=>'13265175867',
            );
            $res = $obj->send($param);
            print_r($res);
            return Common::show(config('code.success'),'发送成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
