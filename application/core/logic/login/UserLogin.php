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
        print_r(explode(',',$areaids));die;
        $lists = Common::D('area','Area')->getlis();

    }
}