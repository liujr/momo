<?php
/**
 * 后台菜单
 */
namespace app\home\controller;
use app\common\Common;
class Diy extends Base {

    /**
     *获取左边菜单列表
     */
    public function index(){
        try{
            return $this->fetch();
        }catch (\Exception $e){
          $this->error($e->getMessage());
        }
    }

}