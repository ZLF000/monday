<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{

    public function index() {

        return $this->fetch();

    }

    public function getData() {
        $id = $_GET['id'];

        $list = Db::table('user_detail')->where('id', $id)->select();

        return sucReturn(200, 'succcess', $list);
    }
}
