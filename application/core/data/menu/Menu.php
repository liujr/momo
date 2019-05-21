<?php

namespace data\menu;
use app\common\Common;
use think\Db;
class Menu{
    /**
     * 获取一条用户信息
     */
    public function info($param){
        if($param['id']) $where['id'] = $param['id'];
        if($param['pid']) $where['pid'] = $param['pid'];
        $where['status'] = 1;
        $info = Db::name('menu')->where($where)->find();
        return $info;
    }

    /**
     * 统计当前id有没有子节点
     * @param $id
     * @return int|string
     */
    public function count($id){
       $where['pid'] = $id;
        $where['status'] = 1;
        $num = Db::name('menu')->where($where)->count();
        return $num;
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
     * 修改数据
     * @param $param
     * @return int|string
     */
    public function edit($param){
        if(!$param['id']) Common::E('非法访问！');
        $data = $this->checkData($param);
        $insertData = $this->data($data);
        $result = Db::name('menu')->where(['id'=>$param['id']])->update($insertData);
        return $result;
    }

    /**
     * 删除数据
     * @param $id
     */
    public function del($id){
        if(!$id) Common::E('非法访问！');
        $result = Db::name('menu')->where(['id'=>$id])->update(['status'=>2]);
        return $result;
    }

    /**
     * 检测数据合法性
     */
    private function checkData($param){
        if(!$param['menuurl']) Common::E('访问路径不能为空！');
        if(!$param['menuname']) Common::E('菜单名称不能为空！');
        return $param;
    }
    /**
     * 组装数据
     */
    private function data($param){
        $data = array(
            'pid' =>$param['pid'],
            'menuname'    =>$param['menuname'],
            'menuurl' =>$param['menuurl'],
            'remark'  => $param['remark'],
        );
        return $data;
    }
}