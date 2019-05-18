<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class Menu{
    /**
     * 获取一条用户信息
     */
    public function getInfo($param){
        if($param['id']) $where['id'] = $param['id'];
        if($param['pid']) $where['pid'] = $param['pid'];
        $where['status'] = 1;
        $info = Db::name('menu')->where($where)->find();
        return $info;
    }

    /**
     * 添加数据
     * @param $param
     */
    public function add($param){
        $data = $this->checkData($param);
        $insertData = $this->data($data);
        $result = Db::name('menu')->insert($insertData);

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