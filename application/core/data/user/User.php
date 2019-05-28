<?php
namespace data\user;
use app\common\Common;
use think\Db;
class User{

    /**
     * 获取一条用户信息
     */
    public function info($param){
        if($param['id']) $where['id'] = $param['id'];
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
     * 修改数据
     * @param $param
     * @return int|string
     */
    public function edit($param){
        if(!$param['id']) Common::E('非法访问！');
        $data = $this->checkData($param);
        $insertData = $this->data($data);
        $result = Db::name('user')->where(['id'=>$param['id']])->update($insertData);
        return $result;
    }

    /**
     * 删除数据
     * @param $id
     */
    public function del($id){
        if(!$id) Common::E('非法访问！');
        $result = Db::name('user')->where(['id'=>$id])->update(['datastatus'=>2]);
        return $result;
    }

    /**
     * 检测数据合法性
     */
    private function checkData($param){
        if(!$param['mobile']) Common::E('手机号不能为空！');
        if(!$param['password']) Common::E('密码不能为空！');
        return $param;
    }
    /**
     * 组装数据
     */
    private function data($param){
        $data = array(
            'account' =>$param['account'],
            'mobile' => $param['account'],
            'password' => $param['password'],
            'sign' => $param['sign'],
            'avatar' =>$param['avatar'],
            'sex' => $param['sex'],
            'age' => $param['age'],
            'pid' => $param['pid'],
            'cid' => $param['cid'],
            'aid' => $param['aid'],
            'address' => $param['address'],
            'is_online' => $param['is_online'],
            'addtime' =>$param['addtime'],
        );
        return $data;
    }
}