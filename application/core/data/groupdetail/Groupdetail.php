<?php
namespace data\groupdetail;
use app\common\Common;
use think\Db;

class Groupdetail{

    public function add($param){
        $this->checkdata($param);
        $insertData = $this->getdata($param);
        $result = Db::name('groupdetail')->insert($insertData);
        return $result;
    }

    private function checkdata($param){
        if(!$param['user_name']) Common::E('用户名称不能为空');
        if(!$param['user_id']) Common::E('用户id不能为空');
        if(!$param['user_avatar']) Common::E('用户头像不能为空');
        if(!$param['user_sign']) Common::E('用户签名不能为空');
        if(!$param['group_id']) Common::E('群组id不能为空');
    }

    private function getdata($param){
        $param = [
            'user_name'=>$param['user_name'],
            'user_id'=>$param['user_id'],
            'user_avatar' =>$param['user_avatar'],
            'user_sign'  =>$param['user_sign'],
            'group_id'=>$param['group_id'],
        ];
        return $param;
    }

}