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
            $obj = new \logic\msgbox\Msgbox();
            $res = $obj->add($uid,$remark,$from_group,session('userid'),1,$content);
            Common::show(config('code.success'),'修改成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
}