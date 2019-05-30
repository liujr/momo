<?php
namespace app\home\controller;
use app\common\Common;
class Friendscategory extends Base {
    public function lists() {
        try{
            $categoryObj = new \logic\friendscategory\FriendsCategory();
            $lists = $categoryObj->lists();
            $this->assign(get_defined_vars());
            return $this->fetch();
        }catch (\Exception $e){
            $this->error($e->getMessage(),'/home/index/index');
        }
    }


    /**
     * 添加分类
     * @return mixed
     */
    public function add(){
        try{
            if(!Request()->isPost()) return $this->fetch();

            $data = $this->getdata();
            $categoryObj = new \logic\friendscategory\FriendsCategory();
            $res = $categoryObj->add($data);
            Common::show(config('code.success'),'添加分类成功',$res);
        }catch (\Exception $e){
            if(!Request()->isPost()) $this->error($e->getMessage());
            Common::show(config('code.error'),$e->getMessage());
        }

    }

    /**
     * 修改分类
     * @return mixed
     */
    public function edit(){
        try{
            $categoryObj = new \logic\friendscategory\FriendsCategory();
            $id = input('id');
            if(!Request()->isPost()){
                $info = $categoryObj->info($id);
                $this->assign(get_defined_vars());
                return $this->fetch();
            }
            $data = $this->getdata();
            $data['id'] = $id;
            $res = $categoryObj->edit($data);
            Common::show(config('code.success'),'修改分类成功',$res);
        }catch (\Exception $e){
            if(!Request()->isPost()) $this->error($e->getMessage());
            Common::show(config('code.error'),$e->getMessage());
        }
    }

    private function getdata(){
        return [
            'groupname' =>input('groupname'),
        ];
    }

}
