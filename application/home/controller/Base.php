<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/18
 * Time: 15:37
 */

namespace app\home\controller;
use \think\Controller;

class Base extends Controller{
    protected $request;
    protected $app;
    public function __construct(){
        parent::__construct();
        $this->checklogin();
    }

    public function checklogin(){
        $res = session(config('config.admin_user_login'));
        if(!$res) $this->redirect('/home/login/index');
    }

}