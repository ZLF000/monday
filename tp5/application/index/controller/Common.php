<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Common extends Controller {

    protected function _initialize()
    {
        $adminInfo = Session('adminInfo');

        if (!$adminInfo) {

            $this->redirect('/index/login/index');

        }

        $roleId = $adminInfo['role_id'];

        switch ($roleId) {

            case 1:
                //管理员
                break;

            default:
                break;
        }

        $request = Request::instance();
        $controller = $request->controller();
        $action = $request->action();
        $alias = strtolower($controller) . '/' . strtolower($action);


        $isExist = Db::table('pay_role_rule')->alias('r')
            ->join('pay_rules t', 'r.rule_id = t.id')
            ->where('r.role_id', $roleId)
            ->where('t.status', '1')
            ->where('t.rule_alias', $alias)
            ->find();

        if (!$isExist) {
            if ($request->isAjax()) {

               echo errReturn(400, '暂无权限', 1);
               die();
            }
            $this->error('暂无权限');
        }


        $this->assign('title', '易支付管理系统');
    }

}
