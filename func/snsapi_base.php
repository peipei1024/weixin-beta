<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/16
 * Time: 10:16
 * Describe:
 */

require_once '../weixin_oop_api.php';
$appid = "wx3f69126e35cab2ed";
$appsecret = "5610953c67d15e184c9af9b53511f1fb";

$redirect_uri = 'http://www.pxz1004.cn/func/snsapi_base.php';
$encode_redirect_uri = urlencode($redirect_uri);

$wx = new weixin_oop_api($appid, $appsecret);
$reslut = $wx->snsapi_base_api($encode_redirect_uri);
echo $reslut;


