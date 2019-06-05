<?php
namespace app\chart\controller;
use app\common\Common;
use app\common\Redis;
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

    /**
     * 添加群组
     */
    public function doadd(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $group_name = input('group_name');
            $avatar = input('avatar');
            $owner_name = session('username');
            $owner_id = session('userid');
            $owner_avatar = session('avatar');
            $owner_sign = session('sign');
            $status = 2;
            //添加群组
            $groupObj  = new \logic\chartgroup\ChartGroup();
            $groupid = $groupObj->add($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status);

            //将自己加入群组
            $groupdetailObj  = new \logic\groupdetail\Groupdetail();
            $groupdetailObj->add($owner_id,$owner_name,$owner_avatar,$owner_sign,$groupid);

            Common::show(config('code.success'),'添加成功',['join_id'=>$owner_id,'group_id'=>$groupid]);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 搜索群组
     */
    public function ajaxlists(){
        try{
            $groupname= input('search_txt');
            if($groupname =='') Common::E('群组名称不能为空');
            $groupObj  = new \logic\chartgroup\ChartGroup();
            $groupArr  =$groupObj->lists(0,0,2,'',1,20,$groupname);
            Common::show(config('code.success'),'搜索成功',$groupArr);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 群组添加成功渲染到页面
     * @param $ws
     * @param $fd
     * @param $message
     */
    static public function pushGroup($ws,$fd,$message){
        Redis::getInstance()->sAdd('group'.$message['groupid'],$message['userid']);
        $add_message = [
            'message_type' => 'addGroup',
            'data' => [
                'type' => 'group',
                'avatar'   => $message['avatar'],
                'id'       => $message['groupid'],
                'groupname'     => $message['groupname']
            ]
        ];
        $nowfd = Redis::getInstance()->get(config('redis.userid_association_fd').$message['userid']);
        $ws->push($nowfd, json_encode($add_message));
    }


    /**
     * 申请加入群组
     */
    public function checkgroup(){
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $group_id = input('group');

            //将自己加入群组
            $groupdetailObj  = new \logic\groupdetail\Groupdetail();
            $info = $groupdetailObj->info($group_id,session('userid'));
            if(!empty($info)) Common::E('您已经加入了该群组');
            $return = [
                'uid' => session('userid'),
                'uname' => session('username'),
                'avatar' => session('avatar'),
                'sign' => session('sign')
            ];
            Common::show(config('code.success'),'添加成功',$return);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 申请 加入群
     * @param $ws
     * @param $fd
     * @param $message
     */
    static public function applyGroup($ws,$fd,$message){
        Redis::getInstance()->sAdd('group'.$message['groupid'],$message['userid']);
        $add_message = [
            'message_type' => 'addGroup',
            'data' => [
                'type' => 'group',
                'avatar'   => $message['avatar'],
                'id'       => $message['groupid'],
                'groupname'     => $message['groupname']
            ]
        ];
        $nowfd = Redis::getInstance()->get(config('redis.userid_association_fd').$message['userid']);
        $ws->push($nowfd, json_encode($add_message));
    }

}