<?php
namespace app\chart\controller;

class Index extends Base{

    public function index(){
        $mobile =  session('mobile');
        $userid =  session('userid');
        $sign =  session('sign')?session('sign'):'这家伙很懒！什么也没留';
        $avatar =  session('avatar');
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

    public function getList(){
        $obj = new \logic\login\UserLogin();
        $user = $obj->info(session('userid'));
        $mine = [
            'username' =>$user['account'],
            'id'       =>$user['userid'],
            'status'  =>$user['is_online']==2?'online':'offline',
            'sign'      =>$user['sign']?$user['sign']:'这家伙很懒！什么也没留',
            'avatar' =>$user['avatar'],
        ];
        //朋友
        $categoryObj = new \logic\friendscategory\FriendsCategory();
        $friends = $categoryObj->lists();
        $friendsObj = new \logic\friends\Friends();
        foreach ($friends['lists'] as $k=>&$v){
            $res = $friendsObj->getFriendsByCateId(session('userid'),$v['id']);
            if(!empty($res['lists'])){
                foreach ($res['lists'] as $kk=>&$vv){
                    if($vv['status'] ==1)$vv['status'] ='offline';
                    if($vv['status'] ==2)$vv['status'] ='online';
                }
            }
            $v['list'] = $res['lists'];
        }
        $friend = $friends['lists'];


        //获取当前用户加入的群
        $groupdetailObj  = new \logic\groupdetail\Groupdetail();
        $groupList = $groupdetailObj->lists(session('userid'),1,999);
        $data = [
            'code'=>0,
            'msg' =>'',
            'data' =>[
                'mine' =>$mine,
                'friend'=>$friend,
                'group' =>$groupList['lists']
            ]
        ];
        echo json_encode($data);
    }

    /**
     * 获取群组成员
     */
    public function memberListUrl(){
        $groupid = input('id');
        $groupdetailObj  = new \logic\groupdetail\Groupdetail();
        $list = $groupdetailObj->getlistsBygroupid($groupid);
        $data =[
            'code'=>0,
            'msg' =>'',
            'data'=>[
                'list' => $list['lists']
            ]
        ];
        echo json_encode($data);
    }

    public function uploadImgUrl(){
        $data = [
            'code'=>0,
            'msg'  =>'',
            'data'=>[
                'src'=>'http://momo.mmrui.cn/static/common/layui/images/face/0.gif'
            ],
        ];
        echo json_encode($data);

    }

    public function uploadFileUrl(){
        $data = [
            'code'=>0,
            'msg'  =>'',
            'data'=>[
                'src'=>'http://momo.mmrui.cn/static/common/layui/images/face/0.gif'
            ],
        ];
        echo json_encode($data);

    }


    public function  msgBoxUrl(){
        $username =  session('mobile');
        $uid =  session('userid');
        $sign =  session('sign')?session('sign'):'这家伙很懒！什么也没留';
        $avatar =  session('avatar');
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

    /**
     * 添加好友
     */
    public function  findUrl(){
        try{
            $friendsObj = new \logic\friends\Friends();
            $friends =$friendsObj->lists(session('userid'));
            if(!empty($friends['lists'])){
                foreach($friends['lists'] as $vo){
                    $fArr[] = $vo['friendid'];
                }
            }
            $friendsids = isset($fArr) && (!empty($fArr))? implode(',',$fArr):session('userid');
            $userObj  = new \logic\user\User();
            $userList  =$userObj->lists($friendsids,1,4);
            //初始化省份
            $areaObj = new \logic\area\Area();
            $province =$areaObj->getlistByParentId(0);

            //推荐新建的群组
            $groupObj  = new \logic\chartgroup\ChartGroup();
            $groupArr  =$groupObj->lists(0,0,2,'',1,4);

                $this->assign([
                'group' => $groupArr['lists'],
                'age' => ['0-18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35-120'],
                'province' => $province['list'],
                'user' => $userList['lists']
            ]);
            return $this->fetch();
        }catch (\Exception $e){
            $this->error($e->getMessage(),'/chart/index/index');
        }


    }
    public function  chatlogUrl(){

    }



}