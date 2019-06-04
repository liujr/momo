<?php
namespace data\friendscategory;
use app\common\Common;
use think\Db;
class FriendsCategory{
    /**
     * 分类详情
     * @param $id
     * @return mixed
     */
    public function info($id){
        $where['id'] = $id;
        $info = Db::name('friendscategory')->where($where)->find();
        return $info;
    }



    /**
     * 添加分类
     * @param $param
     * @return bool
     */
    public function add($param){
        $data = $this->getdata($param);
        $data['addtime'] = time();
        $ret =  Db::name("friendscategory")->insertGetId($data);
        if(!$ret) Common::E("添加管理员失败");
        return true;
    }
    /**
     * 修改分类
     * @param $param
     * @return bool
     */
    public function edit($param){
        if(!$param['id']) Common::E('非法访问！');
        $data = $this->getdata($param);
        $ret =  Db::name("friendscategory")->where(['id'=>$param['id']])->update($data);
        if(!$ret) Common::E("添加管理员失败");
        return true;
    }

    private function getdata($param){
        return [
            'groupname' =>$param['groupname'],
        ];
    }
}