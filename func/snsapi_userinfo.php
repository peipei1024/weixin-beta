<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/16
 * Time: 16:30
 * Describe:
 */

require_once '../weixin_oop_api.php';
$appid = "wx3f69126e35cab2ed";
$appsecret = "5610953c67d15e184c9af9b53511f1fb";
$appidjianshi = "wx28427b71c414e427";
$appsecretjianshi = "d04c23d8701dad247b7f066fef12a6c0";
$redirect_uri = 'http://www.pxz1004.cn/func/snsapi_userinfo.php';
$encode_redirect_uri = urlencode($redirect_uri);

$wx = new weixin_oop_api($appid, $appsecret);
$reslut = $wx->snsapi_userinfo_api($encode_redirect_uri);
echo $reslut;