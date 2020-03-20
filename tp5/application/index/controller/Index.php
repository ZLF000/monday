<?php
namespace app\index\controller;

use think\Db;

class Index
{
    public function index()
    {
        $list = Db::table('user_detail')->select();

        var_dump($list);
    }
}
