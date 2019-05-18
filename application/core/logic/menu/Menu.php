<?php
/**
 * 菜单列表
 */
namespace logic\menu;
use app\common\Common;
class Menu{
        /**
         *获取左边菜单列表
         */
        public function lists(){
            $res =  Common::D('menu','MenuLists')->lists();
            $data = Common::nodeMerge($res);
            return $data;
        }

        public function listsBypid(){
            $res =  Common::D('menu','MenuLists')->listsBypid();
            return $res;
        }

}