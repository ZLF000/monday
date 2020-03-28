<?php
namespace app\index\model;
use think\Db;
use think\Model;


class Users extends Model {

    protected $table = 'pay_users';

    public function loginCheck($where) {

        $info = Db::table($this->table)
            ->where($where)
            ->find();

        if (!$info) {
            return errReturn(404, '账号或密码错误');
        }

        if (!$info['status']) {
            return errReturn(400, '该账号已被封禁');
        }

        $roles = Db::name('roles')->where('id', $info['role_id'])->find();

        if (!$roles['status']) {
            return errReturn(400, '该角色暂停使用');
        }

        $info['role_name'] = $roles['role_name'];

        $info['alias'] = $roles['alias'];

        return sucReturn(200, '登录成功', $info);

    }

}
