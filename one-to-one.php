<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/15
 * Time: 10:06
 * Describe:
 */

//$aa = 'http://www.pxz1004.cn/callback_info.html';
//echo urlencode($aa);
$arr = 'aa';
$_SERVER['QUERY_STRING'];
echo $_SERVER['QUERY_STRING'];
if (is_string($_SERVER['QUERY_STRING'])){
    echo 'true';
}else{
    echo 'false';
}

//if (is_string(strval(count($arr)))){
//    echo 'true';
//}else{
//    echo 'false';
//}


//$aa = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3f69126e35cab2ed&redirect_uri=http%3A%2F%2Fwww.pxz1004.cn%2Fsnsapi_base.php&response_type=code&scope=snsapi_userinfo&state=4567#wechat_redirect';
//header("Location : {$aa}");
//header("Location : http://www.baidu.com");
//header('Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3f69126e35cab2ed&redirect_uri=http%3A%2F%2Fwww.pxz1004.cn%2Fsnsapi_base.php&response_type=code&scope=snsapi_userinfo&state=4567#wechat_redirect');