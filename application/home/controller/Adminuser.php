<?php
namespace app\home\controller;

use app\common\Common;
class Adminuser extends Base{
    /**
     * 管理员列表
     * @return mixed
     */
    public function lists(){
        try{
            $keyword = input('keyword');
            $page = input('page',1);
            $limit = input('limit',20);
            $obj = new \logic\admin\Adminuser();
            $lists= $obj->lists(['keyword'=>$keyword,'page'=>$page,'limit'=>$limit]);
            $this->assign(get_defined_vars());
            return $this->fetch();
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }

    /**
     * 添加管理员
     * @return mixed
     */
    public function add(){
        try{
            if(!Request()->isPost()) return $this->fetch();

            $data = $this->getdata();
            $obj = new \logic\admin\Adminuser();
            $res = $obj->add($data);
            Common::show(config('code.success'),'添加管理员成功',$res);
        }catch (\Exception $e){
            if(!Request()->isPost()) $this->error($e->getMessage());
            Common::show(config('code.error'),$e->getMessage());
        }

    }

    /**
     * 修改管理员
     * @return mixed
     */
    public function edit(){
        try{
            $obj = new \logic\admin\Adminuser();
            $id = input('id');
            if(!Request()->isPost()){
                $info = $obj->info($id);
                $this->assign(get_defined_vars());
                return $this->fetch();
            }
            $data = $this->getdata();
            $res = $obj->edit($data);
            Common::show(config('code.success'),'修改管理员成功',$res);
        }catch (\Exception $e){
            if(!Request()->isPost()) $this->error($e->getMessage());
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    /**
     * 删除管理员
     * @return mixed
     */
    public function del(){
        try{
            $id = input('id');
            $obj = new \logic\admin\Adminuser();
            $res = $obj->del($id);
            Common::show(config('code.success'),'删除管理员成功',$res);
        }catch (\Exception $e){
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    private function getdata(){
        return [
            'account' =>input('account'),
            'password' =>input('password'),
            'name' =>input('name'),
            'mobile' =>input('mobile'),
        ];
    }
}