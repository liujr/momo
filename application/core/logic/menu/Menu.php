<?php
/**
 * 菜单列表
 */
namespace logic\menu;
use app\common\Common;
class Menu{
        public function lists(){
            $res =  Common::D('menu','MenuLists')->lists();
            $data = Common::nodeMerge($res);
            echo '<pre>';
            print_r($data);
        }
}