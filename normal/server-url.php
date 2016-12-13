<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/6
 * Time: 10:26
 * Describe:
 */



define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapi();
//$wechatObj->valid();
$wechatObj->responseMsg();




class wechatCallbackapi
{
    /**
     * 接受微信服务器传过来的xml数据
     * 俩种模式：1.普通文本消息
     * 2.事件消息--订阅事件
     */
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
                        $resultStr = $this->handleText($postObj, $this->welcomeText());
                    }else if ($postObj->Content == '2'){
//                        $url = "http://www.pxz1004.cn/weixin/apiJSSDKTest.php";
                        $url = $postObj->FromUserName;
                        $resultStr = $this->handleText($postObj, $url);
                    }
                    break;
                case "event":
                    $resultStr = $this->handleText($postObj, $this->welcomeText());
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


    public function handleText($postObj, $msg)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = $msg;
//        $keyword = trim($postObj->Content);
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
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $msg);
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }


    public function welcomeText(){
        $welcome = "感谢您关注"."\n"."微信号：匠师".
            "\n"."帝都北京，相关信息查询。"."\n"."目前平台功能如下："
            ."\n"."【1】 帮助信息"."\n"."【2】 jssdk"."\n"."更多内容，敬请期待...";
        return $welcome;
    }


    public function valid()
    {
        $echoStr = $_GET["echostr"];

        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
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
