<?php
namespace logic\area;
use app\common\Common;
class Area{

    public function getlistByParentId($parentid){
        if(!$parentid) Common::E('父亲id不存在');
        $lists = Common::D('area','AreaList')->getlistByParentId($parentid);
        return $lists;
    }

}