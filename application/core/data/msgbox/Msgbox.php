<?php
namespace data\msgbox;
use app\common\Common;
use think\Db;
class Msgbox{

    /**
     * 获取一条用户信息
     */
    public function info($param){
        if($param['id']) $where['id'] = $param['id'];
        if($param['pid']) $where['pid'] = $param['pid'];
        $where['status'] = 1;
        $info = Db::name('message')->where($where)->find();
        return $info;
    }

    /**
     * 添加数据
     * @param $param
     */
    public function add($param){
        $data = $this->checkData($param);
        $insertData = $this->data($data);
        echo '<pre>';
        print_r($insertData);die;
        $result = Db::name('message')->insert($insertData);
        return $result;
    }

    /**
     * 检测数据合法性
     */
    private function checkData($param){
        if(!$param['uid']) Common::E('朋友的id不能为空');
        if(!$param['from']) Common::E('发起好友申请的id不能为空');
        if(!$param['from_group']) Common::E('朋友分类不能为空');
        return $param;
    }

    /**
     * 组装数据
     */
    private function data($param){
        $data = array(
            'content' =>$param['content'],
            'uid'    =>$param['uid'],
            'from' =>$param['from'],
            'from_group'  => $param['from_group'],
            'type' =>$param['type'],
            'remark'    =>$param['remark'],
            'href' =>$param['href'],
            'read'  => $param['read'],
            'time' =>$param['time'],
            'agree'    =>$param['agree'],
        );
        return $data;
    }
}