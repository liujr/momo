<?php
namespace logic\area;
use app\common\Common;
class Area{

    public function getlistByParentId($parentid = 0){
        $lists = Common::D('area','AreaList')->getlistByParentId($parentid);
        return $lists;
    }

}