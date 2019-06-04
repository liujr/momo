<?php
namespace logic\groupdetail;
use app\common\Common;

class Groupdetail{

    /**
     * @param int $id
     * @param int $owner_id
     * @param int $status
     * @param string $notownerid
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function lists($usrid,$page=1,$limit=20){
        $lists = Common::D('groupdetail','GroupdetailList')->lists($usrid,$page,$limit);
        return $lists;
    }

    /**
     * 添加群组
     */
    public function add($owner_id,$owner_name,$owner_avatar,$owner_sign,$groupid){
        $this->checkdata($owner_id,$owner_name,$owner_avatar,$owner_sign,$groupid);
        $param = $this->getdata($owner_id,$owner_name,$owner_avatar,$owner_sign,$groupid);
        $res =  Common::D('groupdetail','Groupdetail')->add($param);
        return $res;
    }


    private function checkdata($owner_id,$owner_name,$owner_avatar,$owner_sign,$groupid){

        if(!$owner_name) Common::E('用户名称不能为空');
        if(!$owner_id) Common::E('用户id不能为空');
        if(!$owner_avatar) Common::E('用户头像不能为空');
        if(!$owner_sign) Common::E('用户签名不能为空');
        if(!$groupid) Common::E('群组id不能为空');
    }

    private function getdata($owner_id,$owner_name,$owner_avatar,$owner_sign,$groupid){
        $param = [
            'user_name' =>$owner_name,
            'user_id'  =>$owner_id,
            'user_avatar'=>$owner_avatar,
            'user_sign'   =>$owner_sign,
            'group_id'   =>$groupid,
        ];
        return $param;
    }
}