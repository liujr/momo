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
            $mobile = intval($_GET['mobile']);
            $obj = new Sms('1');
            $param = array(
                'mobile'=>$mobile,
            );
            $res = $obj->send($param);
            return Common::show(config('code.success'),'发送成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
