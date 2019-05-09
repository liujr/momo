<?php
/**
 * 登录
 */
namespace data\login;
use app\common\Common;
use think\Db;
class Login{



    /**
     * 获取一条用户信息
     */
    public function getInfo($userid=0,$mobile=''){
        if(empty($userid) && empty($mobile)) Common::E('用户不存在');
        if($userid) $where['userid'] = $userid;
        if($mobile) $where['mobile'] = $mobile;
        $where['datastatus'] = 1;
        $info = Db::name('user')->where($where)->find();
        return $info;
    }

    /**
     * 添加数据
     * @param $param
     */
    public function add($param){
        $data = $this->checkData($param);
        $insertData = $this->data($data);
        $result = Db::name('user')->insert($insertData);
        return $result;
    }

    /**
     * 检测数据合法性
     */
    private function checkData($param){
        if(!$param['mobile']) Common::E('电话号码不能为空！');
        return $param;
    }
    /**
     * 组装数据
     */
    private function data($param){
        $data = array(
            'account' =>'momo_'.$param['mobile'],
            'mobile'    =>$param['mobile'],
            'addtime'  => time(),
        );
        return $data;
    }

}