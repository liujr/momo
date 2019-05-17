<?php
namespace app\index\controller;
use think\Exception;
use app\common\Common;
use app\common\Redis;
class Chart
{
    /**
     * 推送数据
     */
    public function index(){
        try{

            return Common::show(config('code.success'),'保存成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
