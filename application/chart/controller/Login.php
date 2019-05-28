<?php
namespace app\chart\controller;
use app\common\Common;
class Login extends Base{

    /**
     * 登录页面
     */
     public function index(){
         return $this->fetch();
    }

    /**
     * 注册页面
     */
    public function register(){
        $ip = request()->ip();
        $taobaoUrl = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $taobaoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ( $ch,  CURLOPT_NOSIGNAL,true);//支持毫秒级别超时设置
        curl_setopt($ch, CURLOPT_TIMEOUT, 1200);   //1.2秒未获取到信息，视为定位失败
        $myCity = curl_exec($ch);
        curl_close($ch);

        $myCity = json_decode($myCity, true);

        if('中国' != $myCity['data']['country']){
            $local = ['110000', '110100', '110101'];  //默认定位北京东城
        }else{
            $local = [$myCity['data']['region_id'], $myCity['data']['city_id'], 0];
        }
        unset($myCity);

        $this->assign([
            'local' => $local
        ]);
        return $this->fetch();
    }

    //处理注册
    public function doRegister() {
        try{
            if(!request()->isAjax()) Common::E('非法访问');
            $param = input('post.');
            $obj = new \logic\login\UserLogin();
            $res = $obj->register($param);
            Common::show(config('code.success'),'注册成功成功',['userid'=>$res]);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }

    }





}