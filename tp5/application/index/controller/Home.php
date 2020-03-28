<?php
namespace app\index\controller;

class Home extends Common {

    /**
     * 首页
     * @return mixed
     */
    public function index() {

        return $this->fetch();

    }

}
