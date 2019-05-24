<?php
namespace app\chart\controller;

class Index extends Base{

    public function index(){
        //聊天用户
        $userInfo = [
            'id' => 1,
            'username' => 'admin',
            'avatar' => 'admin',
            'sign' => 'admin'
        ];

        $this->assign([
            'uinfo' => $userInfo
        ]);
        return $this->fetch();
    }

}