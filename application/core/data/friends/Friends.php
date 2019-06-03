<?php

namespace data\friends;
use app\common\Common;
use think\Db;
class Friends{


    /**
     * 添加数据
     * @param $param
     */
    public function add($userid,$friend_id,$group_id){
        $this->checkData($userid,$friend_id,$group_id);
        $insertData = $this->data($userid,$friend_id,$group_id);
        $result = Db::name('friends')->insert($insertData);
        return $result;
    }

    /**
     * 检测数据合法性
     */
    private function checkData($userid,$friend_id,$group_id){
        if(!$userid) Common::E('用户id不存在');
        if(!$friend_id) Common::E('朋友id不存在');
        if(!$group_id) Common::E('分类id不存在');
    }
    /**
     * 组装数据
     */
    private function data($userid,$friend_id,$group_id){
        $data = array(
            'userid' =>$userid,
            'friendid'    =>$friend_id,
            'groupid' =>$group_id,
        );
        return $data;
    }

}