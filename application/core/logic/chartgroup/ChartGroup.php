<?php
namespace logic\chartgroup;
use app\common\Common;

class ChartGroup{
    /**
     * 获取群组列表
     * @param int $id
     * @param int $owner_id
     * @param int $status
     * @param string $notownerid
     * @param int $page
     * @param int $limit
     * @return mixed
     */
    public function lists($id=0,$owner_id=0,$status=2,$notownerid='',$page=1,$limit=20){
        $lists = Common::D('chartgroup','ChartGroupList')->lists($id,$owner_id,$status,$notownerid,$page,$limit);
        return $lists;
    }

    /**
     * 添加群组
     */
    public function add($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status){
            $this->checkdata($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status);
            $param = $this->getdata($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status);
            $res =  Common::D('chartgroup','ChartGroup')->add($param);
            return $res;
    }


    private function checkdata($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status){
         if(!$group_name) Common::E('群组名称不能为空');
        if(!$avatar) Common::E('群组头像不能为空');
        if(!$owner_name) Common::E('群主名称不能为空');
        if(!$owner_id) Common::E('群主id不能为空');
        if(!$owner_avatar) Common::E('群主头像不能为空');
        if(!$owner_sign) Common::E('群主签名不能为空');
        if(!$status) Common::E('审核状态不能为空');
    }

    private function getdata($group_name,$avatar,$owner_name,$owner_id,$owner_avatar,$owner_sign,$status){
        $param = [
            'group_name'=>$group_name,
            'avatar'=>$avatar,
            'owner_name' =>$owner_name,
            'owner_id'  =>$owner_id,
            'owner_avatar'=>$owner_avatar,
            'owner_sign'   =>$owner_sign,
            'status'   =>$status,
            'addtime' =>time(),
        ];
        return $param;
    }
}