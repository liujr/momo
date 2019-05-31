<?php
namespace data\msgbox;
use app\common\Common;
use think\Db;
class Msgbox{

    /**
     * 获取一条用户信息
     */
    public function info(){
        $where['read'] = 1;
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
        $result = Db::name('message')->insert($insertData);
        return $result;
    }

    /**
     * 获取未读的数量
     * @param $userid
     * @return int|string
     * @throws \think\Exception
     */
    public function noread($userid){
        if(!$userid) Common::E('用户id不能为空');
        $where['uid'] = $userid;
        $where['read'] = 1;
        $num = Db::name('message')->where($where)->count();
        return $num;
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