<?php
namespace app\chart\controller;
use app\common\Common;

class Group extends Base{

    /**
     * 检测是否能 添加群组
     */
    public function check(){
        try{
            Common::show(config('code.success'),'可以创建');
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 展示添加页面
     * @return mixed
     */
    public function add(){
        return $this->fetch();
    }

    public function doadd(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $group_name = input('group_name');
            $avatar = input('avatar');
            $owner_name = session('mobile');
            $owner_id = session('userid');
            $owner_avatar = session('avatar');
            $owner_sign = session('sign');
            $status = 2;

            //添加群组
            $groupObj  = new \logic\chartgroup\ChartGroup();
            $groupid = $groupObj->add($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status);

            Common::show(config('code.success'),'添加成功',['join_id'=>$owner_id,'group_id'=>$groupid]);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
}