<?php
/**
 * 后台菜单
 */
namespace app\home\controller;

class Menu{

    /**
     *
     */
    public function ajaxLists($pid){
        try{
            $MenuObj = new \logic\login\Menu();
            $data = $MenuObj->lists($pid);
            Common::show(config('code.success'),'菜单返回成功',$data);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
}