<?php
namespace app\chart\controller;

class User extends Base{

    public function info(){
        $user = [
            'username' =>'纸飞机',
            'id'       =>100000,
            'status'  =>'online',
            'sign'      =>'在深邃的编码世界，做一枚轻盈的纸飞机',
            'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg',
            'sex'     =>1,
            'age'    =>12,
            'pid'    =>110000,
            'cid'    =>110000,
            'aid'    =>110101
        ];
        $this->assign(get_defined_vars());
        return $this->fetch();
    }



}