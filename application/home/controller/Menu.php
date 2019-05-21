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

    /**
     * 菜单列表
     * @return mixed
     */
    public function lists(){
        try{
            $MenuObj = new \logic\menu\Menu();
            $menulist = $MenuObj->lists(0);
            $menulist = array(
                'list' =>$menulist,
                'total' =>count($menulist),
            );
            $this->assign(get_defined_vars());
            return $this->fetch();
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }

    /**
     * 添加菜单
     */
    public function add(){
        try{
            if(!Request()->isPost()) return $this->fetch();
            echo 1111;die;
            $data = $this->checkdate();
            $MenuObj = new \logic\menu\Menu();
            $res= $MenuObj->add($data);
            Common::show(config('code.success'),'添加菜单成功',$res);
        }catch (\Exception $e){
            if(!Request()->isPost()) $this->error($e->getMessage());
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    public function edit(){


        try{
            $MenuObj = new \logic\menu\Menu();
            if(!Request()->isPost()){
                $id = input('id');
                $info= $MenuObj->info($id);
                $this->assign(get_defined_vars());
                return $this->fetch();
            }

            $data = $this->checkdate();
            $res= $MenuObj->add($data);
            Common::show(config('code.success'),'修改菜单成功',$res);
        }catch (\Exception $e){
            if(!Request()->isPost()) $this->error($e->getMessage());
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 检测数据合法性
     * @return array
     */
    private function checkdate(){
        $pid = input('pid');
        $menuurl = input('menuurl');
        $menuname = input('menuname');
        $icon = input('icon');
        $remark = input('remark');
        if(!$menuurl) Common::show(config('code.error'),'访问路径不能为空');
        if(!$menuname) Common::show(config('code.error'),'菜单名称不能为空');
        return [
            'pid' =>$pid,
            'menuurl'=>$menuurl,
            'menuname' =>$menuname,
            'icon' =>$icon,
            'remark' =>$remark
        ];
    }



}