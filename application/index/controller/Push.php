<?php
namespace app\index\controller;
use think\Exception;
use app\common\Common;
use app\common\Redis;
class Push
{
    /**
     * 推送数据
     */
    public function index(){
        try{
            $res = Redis::getInstance()->sMembers(config('redis.online_key'));
            foreach ($res as $k=>$v){
                $_POST['http']->push($v, json_encode($_GET));
            }
            return Common::show(config('code.success'),'保存成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
