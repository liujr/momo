<?php
namespace data\chatlog;
use app\common\Common;
use think\Db;
class Chatlog{

    public function editNeedSend($id){
        if(!$id) Common::E('非法操作');
        $where[] = ['id','=',$id];
        return Db::name('chatlog')->where($where)->update(['need_send'=>0]);
    }

    public function add($param){
        $data = $this->checkData($param);
        $insertData = $this->data($data);
        $result = Db::name('chatlog')->insert($insertData);
        return $result;
    }

    /**
     * 检测数据合法性
     */
    private function checkData($param){
        if(!$param['from_id']) Common::E('会话来源id不能为空');
        if(!$param['from_name']) Common::E('消息来源用户名不能为空');
        if(!$param['from_avatar']) Common::E('来源的用户头像不能为空');
        if(!$param['to_id']) Common::E('会话发送的id不能为空');
        if(!$param['content']) Common::E('发送的内容不能为空');
        if(!$param['timeline']) Common::E('记录时间不能为空');
        if(!$param['type']) Common::E('聊天类型不能为空');
        return $param;
    }
    /**
     * 组装数据
     */
    private function data($param){
        $param = [
            'from_id'=>$param['from_id'],
            'from_name'=>$param['from_name'],
            'from_avatar'=>$param['from_avatar'],
            'to_id'=>$param['to_id'],
            'content'=>$param['content'],
            'timeline'=>$param['timeline'],
            'type'=>$param['type'],
            'need_send'=>$param['need_send'],
        ];
        return $param;
    }

}