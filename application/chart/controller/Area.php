<?php
namespace app\chart\controller;
use app\common\Common;
class Area {


    //修改个人资料
    public function getlistByParentId(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
           $parentid= input('parentid');
            $areaObj = new \logic\area\Area();
            $data =$areaObj->getlistByParentId($parentid);
            Common::show(config('code.success'),'获取成功',$data);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }




}