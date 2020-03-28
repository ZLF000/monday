<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Menu extends Controller {

    public function getNodes() {

        $roleId = isset(Session('adminInfo')['role_id']) ? Session('adminInfo')['role_id'] : '';

        if (!$roleId) {
            return [];
        }
        $ruleIds = Db::name('role_rule')->where('role_id', $roleId)->column('rule_id');

        $id = input('id');

        $where['status'] = 1;
        $where['is_show'] = 1;
        $where['id'] = ['in', $ruleIds];

        if ($id) {
            $where['pid'] = $id;
            $rulesInfo = Db::name('rules')->where($where)->order('sort')->select();
        } else {
            $where['pid'] = 0;
            $rulesInfo = Db::name('rules')->where($where)->order('sort')->select();
        }

        $node = [];
        foreach ($rulesInfo as $v) {
            $where['pid'] = $v['id'];
            $info = Db::name('rules')->where($where)->find();
            if ($info) {
                $hasChildren = 1;
            } else {
                $hasChildren = 0;
            }
            $node[] = [
                'id' => $v['id'],
                'text' => $v['rule_name'],
                'icon'  => $v['icon'],
                'hasChildren'   => $hasChildren,
                'href' => $v['rule_alias'],
            ];
        }
        return $node;
    }

}
