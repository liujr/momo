<?php
namespace data\chartgroup;
use app\common\Common;
use think\Db;

class ChartGroup{

    public function add($param){
        $this->checkdata($param);
        $insertData = $this->getdata($param);
        $result = Db::name('chatgroup')->insertGetId($insertData);
        return $result;
    }

    private function checkdata($param){
        if(!$param['group_name']) Common::E('群组名称不能为空');
        if(!$param['avatar']) Common::E('群组头像不能为空');
        if(!$param['owner_name']) Common::E('群主名称不能为空');
        if(!$param['owner_id']) Common::E('群主id不能为空');
        if(!$param['owner_avatar']) Common::E('群主头像不能为空');
        if(!$param['owner_sign']) Common::E('群主签名不能为空');
        if(!$param['status']) Common::E('审核状态不能为空');
    }

    private function getdata($param){
        $param = [
            'group_name'=>$param['group_name'],
            'avatar'=>$param['avatar'],
            'owner_name' =>$param['owner_name'],
            'owner_id'  =>$param['owner_id'],
            'owner_avatar'=>$param['owner_avatar'],
            'owner_sign'   =>$param['owner_sign'],
            'status'   =>$param['status'],
            'addtime' =>$param['addtime'],
        ];
        return $param;
    }

}