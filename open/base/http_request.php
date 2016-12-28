<?php

/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/28
 * Time: 13:54
 * Describe:
 */
class http_request
{
    function _httpGet($url=""){

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    function _httpPost($url, $requestData){

//        $data=array(
//            "name" => "Lei",
//            "msg" => "Are you OK?"
//        );

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, 1);
        //The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
//        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
//        curl_setopt($ch, CURLOPT_POSTFIELDS , http_build_query($requestData));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


        $data_string = json_encode($requestData);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $output = curl_exec($ch);


        curl_close($ch);

        return $output;
    }
}