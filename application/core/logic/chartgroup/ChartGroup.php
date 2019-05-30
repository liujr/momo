<?php
namespace logic\chartgroup;
use app\common\Common;

class ChartGroup{
    public function lists($id=0,$owner_id=0,$status=2,$notownerid='',$page=1,$limit=20){
        $lists = Common::D('chartgroup','ChartGroupList')->lists($id,$owner_id,$status,$notownerid,$page,$limit);
        return $lists;
    }
}