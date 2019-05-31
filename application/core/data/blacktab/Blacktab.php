<?php
namespace data\blacktab;
use app\common\Common;
use think\Db;
class Blacktab{

    /**
     * 详情
     * @param $id
     * @return mixed
     */
    public function info($user_id,$put_uid){
        $where[] = ['user_id','=',$user_id];
        $where[] = ['put_uid','=',$put_uid];
        $info = Db::name('blacktab')->where($where)->find();
        return $info;
    }
}