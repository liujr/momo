<?php
namespace logic\login;
use app\common\Common;

class UserLogin{

    public function register($param){
        if(!$param['mobile']) Common::E('电话号码不能为空');
        if(!$param['pwd']) Common::E('密码不能为空');
        if(!$param['repwd']) Common::E('确认密码不能为空');
        if($param['pwd'] != $param['repwd']) Common::E('两次密码输入不一致');
        if($param['province']) $areaids[] = $param['province'];
        if($param['city']) $areaids[] = $param['city'];
        if($param['area']) $areaids[] = $param['area'];
        $lists = Common::D('area','AreaList')->getlist(['ids'=>implode(',',$areaids)]);
        $areaStr = '';
        if(!empty($area)){
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
            'avatar' => config('config.user_avatar'),
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
        return Common::D('user','User')->add($insertData);

    }
}