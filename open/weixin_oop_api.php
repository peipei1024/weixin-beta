<?php

/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/16
 * Time: 9:58
 * Describe:
 */
class weixin_oop_api
{
    private $appid;
    private $appsecret;

    public function __construct($appid, $appsecret)
    {
        $this->appid = $appid;
        $this->appsecret = $appsecret;

    }

    /**snsapi_userinfo授权
     * @param $redirect_uri，回调的链接
     * @return mixed json
     * { "access_token":"ACCESS_TOKEN",  网页授权接口调用凭证,注意：此access_token与基础支持的access_token不同
     * "expires_in":7200, access_token接口调用凭证超时时间，单位（秒）
     * "refresh_token":"REFRESH_TOKEN", 用户刷新access_token
     * "openid":"OPENID", 用户唯一标识
     * "scope":"SCOPE" } 用户授权的作用域
     */
    public function snsapi_userinfo_api($redirect_uri){

        $snsapi_userinfo_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=4567#wechat_redirect";

        if (!isset($_GET['code'])){
//            这里神坑，Location和冒号之间不能加空格，加了不执行
//            header("Location : {$snsapi_userinfo_url}");
            header("Location: {$snsapi_userinfo_url}");
        }
        $code = $_GET['code'];

        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";

        return $this->httpGet($url);

    }

    /**snsapi_base授权
     * @param $redirect_uri，回调的链接
     * @return mixed json
     * { "access_token":"ACCESS_TOKEN",  网页授权接口调用凭证,注意：此access_token与基础支持的access_token不同
     * "expires_in":7200, access_token接口调用凭证超时时间，单位（秒）
     * "refresh_token":"REFRESH_TOKEN", 用户刷新access_token
     * "openid":"OPENID", 用户唯一标识
     * "scope":"SCOPE" } 用户授权的作用域
     */
    public function snsapi_base_api($redirect_uri){

        $snsapi_base_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';

        if (!isset($_GET['code'])){
            header("Location: {$snsapi_base_url}");
        }

        $code = $_GET['code'];

        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appsecret}&code={$code}&grant_type=authorization_code";

        return $this->httpGet($url);

    }

    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);//TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}