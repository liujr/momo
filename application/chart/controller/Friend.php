<?php
namespace app\chart\controller;
use app\common\Common;
class Friend extends Base{


    public function agree(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $userid = session('userid');
            $friend_id = input('uid');
            $group_id = input('group');
            $from_group = input('from_group');
            //将我与请求人建立关系
            $obj = new \logic\friends\Friends();
            $obj->add($userid,$friend_id,$group_id);

            //将请求人与我建立关系
            $obj->add($friend_id,$userid,$from_group);

            //入库系统消息
            $content = session('mobile') . ' 已经同意你的好友申请';
            $obj = new \logic\msgbox\Msgbox();
            $res = $obj->add($friend_id,'',$from_group,$userid,2,$content,'');

            //将此消息标记为已经同意
            $obj->agree(input('id'),1);

            Common::show(config('code.success'),'申请成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

}