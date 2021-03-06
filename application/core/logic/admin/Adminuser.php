<?php
namespace logic\admin;
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
     * 管理员详情
     * @param $id
     * @return mixed
     */
    public function info($id){
        if(!$id) Common::E('非法访问');
        $lists = Common::D('admin','Adminuser')->info($id);
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
        $data['id'] =$param['id'];
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
        if(!Common::is_menber_english($param['account'])) Common::E('账号只能输英文数字组合');
        if(strlen($param['account']) < 5  ||  strlen($param['account']) > 10) Common::E('账号5-10位数字和字母的组合');
        if(strlen($param['password']) < 6 ||  strlen($param['password']) > 16) Common::E('密码6-16位数字和字母的组合');
        if(!Common::is_mobile($param['mobile'])) Common::E('手机号码不合法');
        return [
            'account' =>$param['account'],
            'password' =>md5(md5($param['password']).$param['account']),
            'name' =>$param['name'],
            'mobile' =>$param['mobile'],
        ];
    }


}