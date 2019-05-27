<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use app\common\Redis;
use app\common\Common;
function code(){
    $randnum = Common::randnum(4,0);//随机获取4位数
    $num = strtolower($randnum);
    Redis::getInstance()->set(config('config.admin_login_code'),$num,config('config.admin_login_out'));
    return $randnum;
}