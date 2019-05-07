<?php
namespace app\index\controller;
use app\common\Sms;

class Index
{
    public function index()
    {
        print_r($_GET);
    	echo 'wertyu';
        //return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function test(){
    	echo 111;
    }
    public function test2(){
    	echo 222;
    }
    public function test3(){
    	echo 333;
    }


    public function send(){
        $obj = new Sms(1);
        $param = array(
                'mobile'=>'13265175867',
            );
        $res = $obj->send($param);
        print_r($res);
    }
}
