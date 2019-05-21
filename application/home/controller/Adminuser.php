<?php
namespace app\home\controller;

use app\common\Common;
class Adminuser extends Base{
    /**
     * 管理员列表
     * @return mixed
     */
    public function lists(){
        try{

            $this->assign(get_defined_vars());
            return $this->fetch();
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }
}