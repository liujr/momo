<?php
namespace app\chart\controller;
use app\common\Common;

class Group extends Base{

    public function check(){
        try{
            Common::show(config('code.success'),'可以创建');
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    public function add(){
        return $this->fetch();
    }
}