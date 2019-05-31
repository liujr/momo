<?php
namespace app\chart\controller;
use app\common\Common;
class Msgbox extends Base {

    public function applyFriend(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $uid = input('uid');
            $remark = input('remark');
            $from_group = input('from_group');
            $content = '申请添加你为好友';
            //申请好友前检查对方是否将你加入黑名单
            $obj = new \logic\blacktab\Blacktab();
            $obj->info($uid,session('userid'));

            //添加申请数据
            $obj = new \logic\msgbox\Msgbox();
            $res = $obj->add($uid,$remark,$from_group,session('userid'),1,$content);
            Common::show(config('code.success'),'申请成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
}