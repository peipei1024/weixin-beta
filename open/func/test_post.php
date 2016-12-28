<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/28
 * Time: 15:55
 * Describe:
 */
define('ENCODINGAESKEY', 'tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc');
define('APPID', 'wx675ba5140e09984d');//component_appid
define('TOKEN', 'weixin');
define('APPSECRET', '4dda1514bded0b40312e2d41fab4cec1');//component_appsecret

$url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
//    {
//        "component_appid":"appid_value" ,
//        "component_appsecret": "appsecret_value",
//        "component_verify_ticket": "ticket_value"
//    }

$postData = array("component_appid"=>APPID, "component_appsecret"=>APPSECRET, "component_verify_ticket"=>'component_verify_ticket');
echo APPID.'  '.APPSECRET.' <br> ';



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
//The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_POSTFIELDS , http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,true); ;
//curl_setopt($ch,CURLOPT_CAINFO,dirname(__FILE__).'/cacert.pem');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
var_dump(curl_error($ch));
$output = curl_exec($ch);
var_dump($output);


echo curl_errno($ch);
$info = curl_getinfo($ch);
echo '<br>'.$info["http_code"];
//echo gettype($output);
//if ($output){
//    echo 'true';
//}else{
//    echo 'false';
//}
curl_close($ch);