<?php
namespace logic\adminuser;
use app\common\Common;
class Adminuser{

    /**
     * 管理员列表
     * @param array $param
     */
    public function lists($param=[]){
        $lists = Common::D('admin','Adminuser')->lists($param);
        return $lists;
    }

    /**
     * 添加管理员
     * @param $param
     * @return mixed
     */
    public function add($param){
        $data = $this->checkdata($param);
        $res = Common::D('admin','Adminuser')->add($data);
        return $res;
    }

    /**
     * 修改管理员
     * @param $param
     * @return mixed
     */
    public function edit($param){
        $data = $this->checkdata($param);
        $res = Common::D('admin','Adminuser')->edit($data);
        return $res;
    }

    /**
     * 删除管理员
     * @param $id
     * @return mixed
     */
    public function del($id){
        if(!$id) Common::E('非法访问');
        $res = Common::D('admin','Adminuser')->del($id);
        return $res;
    }

    private function checkdata($param){
        if(!$param['account']) Common::E('账号不能为空');
        if(!$param['password']) Common::E('密码不能为空');
        if(!$param['name']) Common::E('姓名不能为空');
        if(!$param['mobile']) Common::E('手机号码不能为空');
        if(Common::is_mobile($param['mobile'])) Common::E('手机号码不合法');
        if(!Common::is_mobile($param['account'])) Common::E('账号只能输英文数字组合');
        return [
            'account' =>$param['account'],
            'password' =>md5(md5($param['password']).$param['account']),
            'name' =>$param['name'],
            'mobile' =>$param['mobile'],
        ];
    }


}