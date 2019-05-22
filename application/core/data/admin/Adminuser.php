<?php
namespace data\login;
use app\common\Common;
use think\Db;
class Adminuser{
    /**
     * 获取管理员列表
     * @param $param
     * @return array
     */
    public function lists($param){
        $page = $param['page']?$param['page']:1;
        $limit = $param['limit']?$param['limit']:20;
        if(!empty($param['keyword']))$where['account|mobile']=array("like","%".$param['keyword']."%");
        $where['status'] = 1;
        $list = Db::name('admin_user')->where($where)->page($page)->limit($limit)->list();
        $total = Db::name('admin_user')->where($where)->count();
        return [
            'lists' => $list,
            'total' =>$total,
            'page'  => $page,
            'limit' => $limit
        ];
    }

    /**
     * 添加管理员
     * @param $param
     * @return bool
     */
    public function add($param){
        $data = $this->getdata($param);
        $data['addtime'] = time();
        $ret =  Db::name("admin_user")->insert($data);
        if(!$ret) Common::E("添加管理员失败");
        return true;
    }
    /**
     * 修改管理员
     * @param $param
     * @return bool
     */
    public function edit($param){
        if(!$param['id']) Common::E('非法访问！');
        $data = $this->getdata($param);
        $ret =  Db::name("admin_user")->update($data);
        if(!$ret) Common::E("添加管理员失败");
        return true;
    }

    /**
     * 删除数据
     * @param $id
     */
    public function del($id){
        if(!$id) Common::E('非法访问！');
        $result = Db::name('admin_user')->where(['id'=>$id])->update(['status'=>2]);
        if(!$result) Common::E("删除管理员失败");
        return $result;
    }

    private function getdata($param){
        return [
            'account' =>$param['account'],
            'password' =>$param['password'],
            'name' =>$param['name'],
            'mobile' =>$param['mobile'],
        ];
    }

}