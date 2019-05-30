<?php
namespace app\chart\controller;
use app\common\Common;
class User extends Base{

    /**
     * 获取详情
     * @return mixed
     */
    public function info(){
        $obj = new \logic\login\UserLogin();
        $user = $obj->info(session('userid'));
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

    //修改个人资料
    public function edit(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $param = input('post.');
            $obj = new \logic\login\UserLogin();
            $res = $obj->edit($param);
            Common::show(config('code.success'),'修改成功');
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 修改签名
     */
    public function editsign(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $param = input('post.');
            $obj = new \logic\login\UserLogin();
            $res = $obj->editsign($param);
            Common::show(config('code.success'),'修改成功');
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * ajax获取列表
     */
    public function ajaxlists(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $mobile = input('mobile');
            $sex = input('sex');
            $age = input('age');
            $pid = input('pid');
            $cid = input('cid');
            $aid = input('aid');
            $obj = new \logic\login\UserLogin();
            $res = $obj->lists($mobile,$sex,$age,$pid,$cid,$aid);
            Common::show(config('code.success'),'修改成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }



}