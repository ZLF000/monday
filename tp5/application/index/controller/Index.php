<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{

    public function index() {

        $url = 'http://vip.vrts.info/api/v1/pay/createOrder';

        $payId = time();
        $merchantId = 103;
        $productId = 100;
        $amount = 100;
        $apikey = 'f85bc92dccc3a9c2337e010bb4bb7157';
        $sign = md5($payId . $merchantId . $productId . $amount . $apikey);

        $data = [
            'payId' => $payId,
            'merchantId' => $merchantId,
            'productId' => $productId,
            'amount' => $amount,
            'callbackUrl' => '',
            'sign' => $sign,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        curl_close($ch);
        print_r($result);
    }

    public function getData() {
        $id = $_GET['id'];

        $list = Db::table('user_detail')->where('id', $id)->select();

        return sucReturn(200, 'succcess', $list);
    }
}
