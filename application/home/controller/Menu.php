<?php
/**
 * 后台菜单
 */
namespace app\home\controller;
use app\common\Common;
class Menu extends Base {

    /**
     *获取左边菜单列表
     */
    public function ajaxLists(){
        try{
            $pid = input('pid');
            $MenuObj = new \logic\menu\Menu();
            $data = $MenuObj->lists($pid);
            Common::show(config('code.success'),'菜单返回成功',$data);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    public function lists(){
        $MenuObj = new \logic\menu\Menu();
        $menulist = $MenuObj->lists(0);
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

}