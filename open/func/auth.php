<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/28
 * Time: 14:52
 * Describe:
 */
include_once '../base/http_request.php';
include_once '../db/DBHelp.php';
include_once '../config/config.php';

//function get_component_access_token(){
    $db = new DBHelp('root', 'root', 'weixin');
    $http_resp = new http_request();
    $sql = "select component_verify_ticket from data where id=1";
    $url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
//    {
//        "component_appid":"wx675ba5140e09984d" ,
//        "component_appsecret": "4dda1514bded0b40312e2d41fab4cec1",
//        "component_verify_ticket": "ticket@@@aD6EwpYGs638coZTfyObnX2cDsizW7YdYRgaiaHFyzaRgOAtpN6CBFVV-FmVQt1i7Hm_wMfze7g6xW3xwkaVyg"
//    }

    $arr = $db->select($sql);
    if ($arr['component_verify_ticket'] != null){
        $postData = array("component_appid"=>APPID, "component_appsecret"=>APPSECRET, "component_verify_ticket"=>$arr['component_verify_ticket']);

        $res = $http_resp->_httpPost($url, $postData);
        echo $res;
    }
