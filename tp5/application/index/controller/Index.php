<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{

    public function index() {

        $this->assign('title', '易支付管理系统');
        return $this->fetch();
    }

}
