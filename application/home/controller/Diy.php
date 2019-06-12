<?php
/**
 * 后台菜单
 */
namespace app\home\controller;
use app\common\Common;
class Diy extends Base {

    /**
     *获取左边菜单列表
     */
    public function index(){
        try{
            $post = $this->request->post('data');
            echo '<pre>';
            print_r($post);die;
            return $this->fetch();
        }catch (\Exception $e){
          $this->error($e->getMessage());
        }
    }

}