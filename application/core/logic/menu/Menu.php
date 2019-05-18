<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/18
 * Time: 14:41
 */
namespace logic\menu;
class Menu{
        public function lists($pid){
            if(empty($pid)) Common::E('电话号码不能为空');
            $data = ['pid'=>$pid,'status'=>1];
            return Common::D('menu','MenuLists')->lists($data);
        }
}