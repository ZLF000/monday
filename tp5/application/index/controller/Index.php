<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        $list = Db::table('user_detail')->select();

        $this->assign('list', $list);
        return $this->fetch();
    }

    public function test() {
        echo 132;
    }
}
