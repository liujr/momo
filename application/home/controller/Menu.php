<?php
/**
 * 后台菜单
 */
namespace app\home\controller;
use app\common\Common;
class Menu{

    /**
     *
     */
    public function ajaxLists(){
        try{
            $MenuObj = new \logic\menu\Menu();
            $data = $MenuObj->lists();
            Common::show(config('code.success'),'菜单返回成功',$data);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
}