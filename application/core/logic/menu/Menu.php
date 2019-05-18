<?php
/**
 * 菜单列表
 */
namespace logic\menu;
use app\common\Common;
class Menu{
        public function lists(){
            $res =  Common::D('menu','MenuLists')->lists();
            print_r($res);die;
            $data = Common::nodeMerge($res);
            print_r($data);
        }
}