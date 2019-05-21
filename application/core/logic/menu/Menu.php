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

    /**
     * 获取顶部菜单
     * @return mixed
     */
        public function listsBypid(){
            $res =  Common::D('menu','MenuLists')->listsBypid();
            return $res;
        }


    /**
     * 获取详情
     * @param $id
     * @return mixed
     */
    public function info($param=[]){
        $res =  Common::D('menu','Menu')->info($param);
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
    public function del($id){
        $num =  Common::D('menu','Menu')->count($id);
        if($num >0) Common::E('存在子节点不能删除');
        $res =  Common::D('menu','Menu')->del($id);
        return $res;

    }

}