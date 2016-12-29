<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/29
 * Time: 10:55
 * Describe:
 */
include_once '../base/http_request.php';
include_once 'auth.php';

$auth_code = $_GET['auth_code'];
$expires_in = $_GET['expires_in'];

//https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token=xxxx
//POST数据示例:
//{
//    "component_appid":"appid_value" ,
//"authorization_code": "auth_code_value"
//}
echo $auth_code.'  '.$expires_in;
$url = 'https://api.weixin.qq.com/cgi-bin/component/api_query_auth?component_access_token='.get_component_access_token();
$postData = array("component_appid"=>APPID, "authorization_code"=>$auth_code);
$http_request = new http_request();
$reslut = $http_request->_httpPost($url, $postData);

echo $reslut;

preauthcode@@@rVbiZxL8TPd8eVbRfl9BUoqUeouCK_LVUa5wikNjQOIYWEEiNnk6UH6iAtLS0Nsbqueryauthcode@@@CRBiy4L0fTq8Is7KJ8GLgGCFck20Q118Ree97lPokMBKdnKqn0a-
hYoQ_arS7zzhYYFFAqPtqKqjPB9dwI0baA 3600
{"authorization_info":
    {   "authorizer_appid":"wx13c168c4eb0e5e62",
        "authorizer_access_token":"FhDbWhMe3VtsGtLy_ZFMwvfGcNth76OZO-5MhgRNyNIC1QoZZ6-uU-wN--F4H7Md22zSQHImLKhDHlP4YK-jEdLFKSQIU7FJARDlWeQUm4Zuq4gFBMrn0--uUTUvCvPDKQVbALDPVA",
        "expires_in":7200,
        "authorizer_refresh_token":"refreshtoken@@@Q32wbPAKpGd2d4Gkx7VaK6_R6g-rPehTlrvU87L1t0Y",
        "func_info":[
                        {"funcscope_category":{"id":1}},
                        {"funcscope_category":{"id":15}},
                        {"funcscope_category":{"id":4}},
                        {"funcscope_category":{"id":7}},
                        {"funcscope_category":{"id":2}},
                        {"funcscope_category":{"id":3}}
                    ]
    }
}

