<?php
/**
 * 菜单列表
 */
namespace logic\menu;
use app\common\Common;
class Menu{
        public function lists($pid){
            if(empty($pid)) Common::E('电话号码不能为空');
            $data = ['pid'=>$pid,'status'=>1];
            $res =  Common::D('menu','MenuLists')->lists($data);
            $data = Common::nodeMerge($res);
            print_r($data);
        }
}