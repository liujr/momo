<?php
namespace app\index\controller;
use think\Exception;
use app\common\Common;
class Push
{
    /**
     * 发送短信
     */
    public function index(){
        try{
            $_POST['http']->push(3, json_encode($_GET));
            return Common::show(config('code.success'),'上传成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
