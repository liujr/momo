<?php
namespace app\home\controller;
class Index extends Base {
    public function index() {
        $MenuObj = new \logic\menu\Menu();
        $data = $MenuObj->listsBypid();
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

}
