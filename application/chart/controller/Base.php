<?php

namespace app\chart\controller;
use \think\Controller;

class Base extends Controller{

    public function initialize(){
        if(empty(session('userid'))){
            $this->redirect(url('/chart/login/index'));
        }
    }
}