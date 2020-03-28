<?php
namespace app\index\controller;

use app\index\model\Users;
use think\Controller;


class Login extends Controller {
    /**
     * 登录
     * @return mixed
     */
    public function index() {

       $adminInfo = Session('adminInfo');

       if ($adminInfo) {
           $this->redirect('/index/index/index');
       }

        return $this->fetch();
    }

    /**
     *
     * 登录校验
     * @return false|string
     */
    public function check() {

        $account = trim(input('account'));
        $password = trim(input('password'));

        $user = new Users();
        $where['account'] = $account;
        $where['password'] = $password;
        $info = $user->loginCheck($where);
        if ($info['code'] == 200) {
            Session('adminInfo', $info['data']);
        }
        return $info;
    }


    public function logout() {

        session('adminInfo', null);
        $this->redirect('/index/login/index');
    }

}
