<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/18
 * Time: 15:37
 */

namespace app\home\controller;
use \think\Controller;
use think\Request;
class Base extends Controller{
    protected $request;
    public function __construct(Request $request){
        parent::__construct($request);
        $this->checklogin();
    }

    public function checklogin(){
        $res = session(config('config.admin_user_login'));
        if(!$res) $this->redirect('/home/login/index');
    }

}