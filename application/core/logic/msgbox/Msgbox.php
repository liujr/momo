<?php
namespace logic\msgbox;
use app\common\Common;
class Msgbox{

    public function lists($uid,$page=1,$limit=20){
        if(!$uid) Common::E('用户id不存在');
        return Common::D('msgbox','MsgboxList')->lists($uid,$page,$limit);
    }

    /**
     * @param $friendid  朋友id
     * @param $remark  验证信息
     * @param $from_group  朋友分类id
     * @param $userid  用户id
     */
    public function add($friendid,$remark='',$from_group,$userid,$type,$content='',$url =''){
        if(!$friendid) Common::E('不存在该好友');
        if(!$userid) Common::E('用户id不存在');
        $data= $this->getdata(['content'=>$content,'uid'=>$friendid,'from'=>$userid,'from_group'=>$from_group,'type'=>$type,'remark'=>$remark,'href'=>$url]);
        return Common::D('msgbox','Msgbox')->add($data);
    }

    /**
     * 获取未读的数量
     * @param $userid
     * @throws \think\Exception
     */
    public function noread($userid){
        if(!$userid) Common::E('用户id不存在');
        return Common::D('msgbox','Msgbox')->noread($userid);
    }

    /**
     * 修改为 已读
     * @param $userid
     * @return mixed
     * @throws \think\Exception
     */
    public function read($userid){
        if(!$userid) Common::E('用户id不存在');
        return Common::D('msgbox','Msgbox')->read($userid);
    }

    private function getdata($param){
        $data = array(
            'content' =>$param['content'],
            'uid'    =>$param['uid'],
            'from' =>$param['from'],
            'from_group'  => $param['from'],
            'type' =>$param['type'],
            'remark'    =>$param['remark'],
            'href' =>$param['href'],
            'read'  => 1,
            'time' =>time(),
            'agree'    =>0,
        );
        return $data;
    }

}