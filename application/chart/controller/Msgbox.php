<?php
namespace app\chart\controller;
use app\common\Common;
class Msgbox extends Base {

    /**
     * 获取未读的信息
     */
    public function getmsg(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $page = input('page');
            $obj = new \logic\msgbox\Msgbox();
            $msg = $obj->lists(session('userid'),$page,5);
            if(empty($msg['lists'])){
                Common::show(config('code.success'),'申请成功','');
            }

            $usrObj = new \logic\user\User();
            foreach($msg['lists'] as $key=>$vo){
                $msg['lists'][$key]['time'] = date('Y-m-d H:i');
                if(1 == $vo['type']){
                    $user = $usrObj->info($vo['from']);
                    $msg['lists'][$key]['user'] = [
                        'id' => $vo['from'],
                        'avatar' => $user['avatar'],
                        'username' => $user['mobile'],
                        'sign' => $user['sign']
                    ];
                }else{
                    $msg['lists'][$key]['user']['id'] = null;
                }
            }
            Common::show(config('code.success'),'成功',$msg);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
    /**
     * 提交申请
     */
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
            $res = $obj->add($uid,$remark,$from_group,0,1,$content);
            Common::show(config('code.success'),'申请成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 获取未读的数量
     */
    public function noread(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');

            //添加申请数据
            $obj = new \logic\msgbox\Msgbox();
            $res = $obj->noread(session('userid'));
            Common::show(config('code.success'),'获取成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 修改为 已读
     * @param $userid
     * @return mixed
     * @throws \think\Exception
     */
    public function read(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');

            //添加申请数据
            $obj = new \logic\msgbox\Msgbox();
            $res = $obj->read(session('userid'));
            Common::show(config('code.success'),'成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }
}