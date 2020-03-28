<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


function sucReturn($code, $message, $data = [], $json = 0) {

    $data = [
        'code' => $code,
        'message' => $message,
        'data' => $data
    ];

    if ($json) {
        return json_encode($data);
    }

    return $data;

}

function errReturn($code, $message, $json = 0) {

    $data = [
        'code' => $code,
        'message' => $message
    ];

    if ($json) {
        return json_encode($data);
    }

    return $data;
}

function doCurl($url, $data = [], $method = 0) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if ($method == 1) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function checkAll($data, $rule) {
    $validate = new \think\Validate($rule);
    $result = $validate->check($data);
    if (!$result) {
        return $validate->getError();
    }
    return true;
}

function getChilds($lists,$pid){
    $list = [];
    $i=0;
    foreach ($lists as $value) {
        if ($value['pid'] == $pid) {
            $list[$i]=$value;
            $children = getChilds($lists,$value['id']);
            if ($children) {
                $list[$i]['children'] = $children;
            }
        }
        $i++;
    }
    if($list){
        $list = array_values($list);
        return $list;
    }else{
        return [];
    }

}