<?php
namespace logic\friendscategory;
use app\common\Common;

class FriendsCategory{
    public function lists(){
        $lists = Common::D('friendscategory','FriendsCategoryList')->lists();
        return $lists;
    }

    /**
     * 分类详情
     * @param $id
     * @return mixed
     */
    public function info($id){
        if(!$id) Common::E('非法访问');
        $lists = Common::D('friendscategory','FriendsCategory')->info($id);
        return $lists;
    }

    /**
     * 添加分类
     * @param $param
     * @return mixed
     */
    public function add($param){
        $data = $this->checkdata($param);
        $res = Common::D('friendscategory','FriendsCategory')->add($data);
        return $res;
    }

    /**
     * 修改分类
     * @param $param
     * @return mixed
     */
    public function edit($param){
        $data = $this->checkdata($param);
        $data['id'] =$param['id'];
        $res = Common::D('friendscategory','FriendsCategory')->edit($data);
        return $res;
    }

    private function checkdata($param){
        if(!$param['groupname']) Common::E('分类名称不能为空');
        return [
            'groupname' =>$param['groupname'],
        ];
    }
}