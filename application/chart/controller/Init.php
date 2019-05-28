<?php
namespace app\chart\controller;
use app\common\Redis;
class Init extends Base{

    static public function index($ws,$fd,$data){
        session('username',$data['username']); //用户名
        session('avatar',$data['avatar']); //头像
        session('id',$data['id']); //用户id
        session('sign',$data['sign']); // 签名

        //将当前用户跟fd绑定
        Redis::getInstance()->set(config('redis.userid_association_fd').$data['id'],$fd);

        //

    }





}