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
echo get_weixin_public_message();


/**刷新并缓存authorizer_access_token
 * 请求示例：https:// api.weixin.qq.com /cgi-bin/component/api_authorizer_token?component_access_token=xxxxx
 * 吐槽，这个url是官网复制来的，仔细看多了俩个空格，会导致请求失败 *
 *          POST数据示例:
 *          {
 *              "component_appid":"appid_value",
 *              "authorizer_appid":"auth_appid_value",
 *              "authorizer_refresh_token":"refresh_token_value",
 *          }
 * 返回示例：{
 *              "authorizer_access_token": "“,
 *              "expires_in":7200，
 *              "authorizer_refresh_token": "refreshtoken@@@Q32wbPAKpGd2d4Gkx7VaK6_R6g-rPehTlrvU87L1t0Y"
 *         }
 * 缓存示例：{
 *              "authorizer_access_token": "“,
 *              "expires_time":45555，//当前时间+6600
 *              "authorizer_refresh_token": "refreshtoken@@@Q32wbPAKpGd2d4Gkx7VaK6_R6g-rPehTlrvU87L1t0Y"
 *         }
 * @return mixed authorizer_access_token
 */
function get_and_refresh_authorizer_access_token(){
    $data = json_decode(file_get_contents('authorizer_access_token.json'));
    if ($data->expires_time < time()){
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_authorizer_token?component_access_token='.get_component_access_token();
        $postData = array("component_appid"=>APPID, "authorizer_appid"=>WEIXIN_PUBLIC_qichang_test, "authorizer_refresh_token"=>$data->authorizer_refresh_token);
        $http_resp = new http_request();
        $reslut = $http_resp->_httpPost($url, $postData);
        $authorizer_access_token = json_decode($reslut)->authorizer_access_token;
        $authorizer_refresh_token = json_decode($reslut)->authorizer_refresh_token;

        $data->authorizer_access_token = $authorizer_access_token;
        $data->expires_time = time() + 6600;
        $data->authorizer_refresh_token = $authorizer_refresh_token;
        $fp = fopen("authorizer_access_token.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
        echo $authorizer_access_token.'  '.$authorizer_refresh_token;
    }else{
        $authorizer_access_token = $data->authorizer_access_token;
        echo $authorizer_access_token;
    }
    return $authorizer_access_token;

}



/**获取pre_auth_code
 * 请求示例：https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token=xxx
 *          POST数据示例:
 *          {
 *              "component_appid":"appid_value"
 *          }
 * 返回示例：{
 *              "pre_auth_code":"Cx_Dk6qiBE0Dmx4EmlT3oRfArPvwSQ-oa3NL_fwHM7VI08r52wazoZX2Rhpz1dEw",
 *              "expires_in":600 //pre_auth_code的有效期
 *         }
 * @return string pre_auth_code
 */
function get_pre_auth_code(){
    $pre_auth_code = '';
    $component_access_token = get_component_access_token();
    if ($component_access_token != null){
        $url = 'https://api.weixin.qq.com/cgi-bin/component/api_create_preauthcode?component_access_token='.$component_access_token;
        $postData = array("component_appid"=>APPID);
        $http_resp = new http_request();
        $reslut = $http_resp->_httpPost($url, $postData);
        $pre_auth_code = json_decode($reslut)->pre_auth_code;
    }
    return $pre_auth_code;
}







/**获取并缓存compoment_access_token，compoment_access_token是第三方平台的下文中接口的调用凭据
 * 注意：每个令牌是存在有效期（2小时）的，且令牌的调用不是无限制的
 * 缓存路径：当前文件目录下的component_access_token.json文件
 * 请求示例：https://api.weixin.qq.com/cgi-bin/component/api_component_token
 *          POST数据示例:
 *          {
 *              "component_appid":"appid_value" ,
 *              "component_appsecret": "appsecret_value",
 *              "component_verify_ticket": "ticket_value"
 *          }
 * 返回示例：{
 *              "component_access_token":"61W3mEpU66027wgNZ_MhGHNQDHnFATkDa9-2llqrMBjUwxRSNPbVsMmyD-yq8wZETSoE5NQgecigDrSHkPtIYA",
 *              "expires_in":7200
 *         }
 * 缓存示例：{
 *              "component_access_token":"61W3mEpU66027wgNZ_MhGHNQDHnFATkDa9-2llqrMBjUwxRSNPbVsMmyD-yq8wZETSoE5NQgecigDrSHkPtIYA",
 *              "expires_time":7200 请求时间+6600（1小时五十分钟）
 *         }
 * @return string compoment_access_token
 */
function get_component_access_token()
{
    $data = json_decode(file_get_contents("component_access_token.json"));
    if ($data->expires_time < time()) {
        $db = new DBHelp('root', 'root', 'weixin');
        $http_resp = new http_request();
        $sql = "select component_verify_ticket from data where id=1";
        $url = "https://api.weixin.qq.com/cgi-bin/component/api_component_token";
        $arr = $db->select($sql);
        $component_access_token = '';
        if ($arr['component_verify_ticket'] != null) {
            $postData = array("component_appid" => APPID, "component_appsecret" => APPSECRET, "component_verify_ticket" => $arr['component_verify_ticket']);
            $res = $http_resp->_httpPost($url, $postData);
            $component_access_token = json_decode($res)->component_access_token;

            $data->component_access_token = $component_access_token;
            $data->expires_time = time() + 6600;
            $fp = fopen("component_access_token.json", "w");
            fwrite($fp, json_encode($data));
            fclose($fp);
//            echo $component_access_token;
        }
    } else {
        $component_access_token = $data->component_access_token;
//        echo $component_access_token;
    }
    return $component_access_token;
}

//https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token=xxxx
//POST数据示例:
//{
//    "component_appid":"appid_value" ,
//"authorizer_appid": "auth_appid_value"
//}
/**
 * 获取授权方的公众号帐号基本信息
 */
function get_weixin_public_message(){
    $url = 'https://api.weixin.qq.com/cgi-bin/component/api_get_authorizer_info?component_access_token='.get_component_access_token();
    $postData = array("component_appid"=>APPID, "authorizer_appid"=>WEIXIN_PUBLIC_qichang_test);
    $http_resp = new http_request();
    $reslut = $http_resp->_httpPost($url, $postData);
    return $reslut;
}