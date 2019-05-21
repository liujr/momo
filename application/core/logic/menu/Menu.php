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

        public function info($id){
            $res =  Common::D('menu','Menu')->info(['id'=>$id]);
            return $res;
        }

    /**
     * 添加数据
     * @param $param
     * @return mixed
     */
        public function add($param){
            $res =  Common::D('menu','Menu')->add($param);
            return $res;
        }

    /**
     * 修改数据
     * @param $param
     * @return mixed
     */
        public function edit($param){
            $res =  Common::D('menu','Menu')->edit($param);
            return $res;
        }

}