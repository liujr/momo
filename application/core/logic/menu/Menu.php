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
        public function lists($pid){
            $res =  Common::D('menu','MenuLists')->lists();
            $data = Common::nodeMerge($res);
            if( $pid ){
                foreach( $data as $val ){
                    if( $val['id'] == $pid ){
                        $templist = $val['children'];
                        break;
                    }
                }
                $data = $templist;
            }
            return $data;
        }

        public function listsBypid(){
            $res =  Common::D('menu','MenuLists')->listsBypid();
            return $res;
        }

}