<?php
namespace logic\login;
use app\common\Common;

class UserLogin{

    public function login($param){
        if(!$param['mobile']) Common::E('电话号码不能为空');
        if(!$param['password']) Common::E('密码不能为空');
        $info = Common::D('user','User')->info(['mobile'=>$param['mobile'],'userid'=>0]);
        return $info;
    }


    /**
     * 注册
     * @param $param
     * @return mixed
     */
    public function register($param){
        $insertData = $this->checkAndGet($param);
        return Common::D('user','User')->add($insertData);

    }

    /**
     * 修改用户上下线
     * @param $param
     * @return mixed
     */
    public function saveisonline($param){
        if(!$param['userid']) Common::E('用户不存在');
        return Common::D('user','User')->saveisonline($param);
    }

    /**
     * 获取用户详情
     * @param $id
     * @return mixed
     */
    public function info($id){
        if(!$id) Common::E('用户不存在');
        $info = Common::D('user','User')->info(['mobile'=>0,'userid'=>$id]);
        return $info;
    }

    /**
     * 修改用户
     * @param $param
     * @return mixed
     */
    public function edit($param){
        $insertData = $this->checkAndGet($param);
        $insertData['id']  = session('userid');
        return Common::D('user','User')->edit($insertData);

    }

    /**
     * 修改签名
     * @param $param
     * @return mixed
     */
    public function editsign($param){
        $param['userid']  = session('userid');
        return Common::D('user','User')->editsign($param);

    }

    /**
     * 获取用户列表
     * @param int $mobile
     * @param int $sex
     * @param int $age
     * @param int $pid
     * @param int $cid
     * @param int $aid
     * @param int $limit
     * @param int $page
     * @return mixed
     */
    public function lists($mobile=0,$sex=0,$age=0,$pid=0,$cid=0,$aid=0,$limit=20,$page=1){
        if(strstr($age,'-')) $age = explode('-',$age);
        return Common::D('user','UserList')->lists(0,$page,$limit,$mobile,$sex,$age,$pid,$cid,$aid);
    }

    private function checkAndGet($param){
        if(!$param['mobile']) Common::E('电话号码不能为空');
        if(!$param['pwd']) Common::E('密码不能为空');
        if(!$param['repwd']) Common::E('确认密码不能为空');
        if($param['pwd'] != $param['repwd']) Common::E('两次密码输入不一致');
        if($param['province']) $areaids[] = $param['province'];
        if($param['city']) $areaids[] = $param['city'];
        if($param['area']) $areaids[] = $param['area'];
        $lists = Common::D('area','AreaList')->getlist(['ids'=>implode(',',$areaids)]);

        $areaStr = '';
        if(!empty($lists['list'])){
            foreach($lists['list'] as $key=>$vo){
                $areaStr .= $vo['area_name'] . '-';
            }
            $areaStr = rtrim($areaStr, '-');
        }else{
            $areaStr = '北京-北京市-东城区';
        }

        $insertData = [
            'account' =>'mm_'.$param['mobile'],
            'mobile' => trim($param['mobile']),
            'password' => md5(md5($param['pwd']).trim($param['mobile'])),
            'sign' => '',
            'avatar' => $param['avatar']?$param['avatar']:config('config.user_avatar'),
            'sex' => $param['sex'],
            'age' => $param['age'],
            'pid' => $param['province'],
            'cid' => $param['city'],
            'aid' => $param['area'],
            'address' => $areaStr,
            'is_online' => 1,
            'addtime' =>time(),
        ];
        echo '<pre>';
        print_r($insertData);die;
        return $insertData;
    }
}