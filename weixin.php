<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/6
 * Time: 10:26
 * Describe: 微信服务器验证，确保消息来自微信服务器
 * 验证规则： 微信服务器传入四个参数signature， timestamp， nonce， echostr，
 * token 为微信后台与第三方服务器约定的字符串
 * 1）将token、timestamp、nonce三个参数进行字典序排序
 * 2）将三个参数字符串拼接成一个字符串进行sha1加密
 * 3）开发者获得加密后的字符串可与signature对比，标识该请求来源于微信。如果数据一致，返回$echostr
 */
//获得参数 signature nonce token timestamp echostr
$signature = $_GET['signature'];
$timestamp = $_GET['timestamp'];
$nonce     = $_GET['nonce'];
$echostr   = $_GET['echostr'];
$token     = 'weixin';

//形成数组，然后按字典序排序
$array = array();
$array = array($nonce, $timestamp, $token);
sort($array);
//拼接成字符串,sha1加密 ，然后与signature进行校验
$str = sha1( implode( $array ) );
if( $str  == $signature && $echostr ){
    //第一次接入weixin api接口的时候
    echo  $echostr;
}


?>