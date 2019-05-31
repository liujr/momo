<?php
namespace logic\msgbox;
use app\common\Common;
class Msgbox{

    /**
     * @param $friendid  朋友id
     * @param $remark  验证信息
     * @param $from_group  朋友分类id
     * @param $userid  用户id
     */
    public function add($friendid,$remark='',$from_group,$userid,$type,$content='',$url =''){
        if(!$friendid) Common::E('不存在该好友');
        if(!$userid) Common::E('用户id不存在');
        $data= $this->getdata(['content'=>$content,'uid'=>$friendid,'from'=>$from_group,'type'=>$type,'remark'=>$remark,'href'=>$url]);
        return Common::D('msgbox','Msgbox')->lists();
    }

    private function getdata($param){
        $data = array(
            'content' =>$param['content'],
            'uid'    =>$param['uid'],
            'from' =>$param['from'],
            'from_group'  => $param['from_group'],
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