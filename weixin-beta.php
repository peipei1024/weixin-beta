<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/6
 * Time: 10:26
 * Describe:
 */


require_once 'JSSDK.php';
define("TOKEN", "weixin");
define('appId', 'wx3f69126e35cab2ed');
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();




class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch($RX_TYPE)
            {
                case "text":
                    $resultStr = '';
                    if ($postObj->Content == '1'){
                        $contentStr = "http://www.pxz1004.cn/weixin/apiJSSDKTest.php";
                        $resultStr = $this->handleText($postObj, $contentStr);
                    }else if ($postObj->Content == '2'){
                        $redirect_uri = urlencode('http://www.pxz1004.cn/weixin/callback_info.html');
                        $contentStr = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".appId.'&redirect_uri='.$redirect_uri.'&response_type=code&scope=snsapi_userinfo&state=#wechat_redirect';
                        $resultStr = $this->handleText($postObj, $contentStr);
                    }else if ($postObj->Content == '3'){
                        $contentStr = "感谢您关注"."\n"."微信号：匠师"."\n"."帝都北京，我就玩玩，相关信息查询。"."\n"."目前平台功能如下："."\n"."【1】 jssdk"."\n"."【2】 授权页面"."\n"."【3】 help"."\n"."更多内容，敬请期待...";
                        $resultStr = $this->handleText($postObj, $contentStr);
                    }
                    break;
                case "event":
                    $resultStr = $this->handleEvent($postObj);
                    break;
                default:
                    $resultStr = "Unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    public function handleText($postObj, $backMessage)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>";
        if(!empty( $keyword ))
        {
            $msgType = "text";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $backMessage);
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }

    public function handleEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "感谢您关注"."\n"."微信号：匠师"."\n"."帝都北京，我就玩玩，相关信息查询。"."\n"."目前平台功能如下："."\n"."【1】 welcome weichat"."\n"."【2】 授权页面"."\n"."【3】 help"."\n"."更多内容，敬请期待...";
                break;
            case "unsubscribe":
                break;
            default :
                $contentStr = "Unknow Event: ".$object->Event;
                break;
        }
        $resultStr = $this->responseText($object, $contentStr);
        return $resultStr;
    }

    public function responseText($object, $content)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $resultStr;
    }

    /**
     * @return bool
     * 获得参数 signature nonce token timestamp echostr
     * 微信服务器验证，确保消息来自微信服务器
     * 验证规则： 微信服务器传入四个参数signature， timestamp， nonce， echostr，
     * token 为微信后台与第三方服务器约定的字符串
     * 1）将token、timestamp、nonce三个参数进行字典序排序
     * 2）将三个参数字符串拼接成一个字符串进行sha1加密
     * 3）开发者获得加密后的字符串可与signature对比，标识该请求来源于微信。如果数据一致，返回$echostr
     */
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}

?>
