<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/29
 * Time: 10:52
 * Describe:
 */
include_once 'auth.php';
include_once '../config/config.php';
$url = 'https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid='.APPID.'&pre_auth_code='.get_pre_auth_code().'&redirect_uri='
.'http://www.pxz1004.cn/func/authorization_code.php';
header("location:{$url}");
?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Title</title>-->
<!--</head>-->
<!--<body>-->
<!--<a href="-->
<!--</body>-->
<!--</html>-->
