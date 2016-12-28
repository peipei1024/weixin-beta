<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/19
 * Time: 10:13
 * Describe:
 */


include_once 'msgcrypt/wxBizMsgCrypt.php';
include_once 'db/DBHelp.php';
include_once 'config/config.php';

$signature    =  $_GET['signature'];
$timeStamp    =  $_GET['timestamp'];
$nonce        =  $_GET['nonce'];
$encrypt_type =  $_GET['encrypt_type'];
$msg_sign     =  $_GET['msg_signature'];
$raw_msg      =  file_get_contents('php://input');
$xml = simplexml_load_string($raw_msg);
$xmlstr = $xml->asXML();

//$token = 'weixin';
//$encodingAesKey = 'tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc';
//$appId = 'wx675ba5140e09984d';



$db = new DBHelp('root', 'root', 'weixin');

$wechat = new WXBizMsgCrypt(TOKEN, ENCODINGAESKEY, APPID);

if ($raw_msg != null){
    $encryptMsg=$raw_msg;
    $xml_tree = new DOMDocument();
    $xml_tree->loadXML($encryptMsg);
    $array_e = $xml_tree->getElementsByTagName('Encrypt');
    $encrypt = $array_e->item(0)->nodeValue;
    $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
    $from_xml = sprintf($format, $encrypt);
    $msg = '';
    $errCode = $wechat->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
    if ($errCode == 0) {

        $xml = new DOMDocument();
        $xml->loadXML($msg);
        $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
        $component_verify_ticket = $array_e->item(0)->nodeValue;

        $sql_mess = "update data set  component_verify_ticket = '$component_verify_ticket', signature = '$signature', timestamp = '$timeStamp', nonce ='$nonce' , encrypt_type = '$encrypt_type', msg_signature = '$msg_sign', raw_msg = '$xmlstr' where id=1";
        $db->insert($sql_mess);

    }else {
        $sql_mess = "update data set  component_verify_ticket = '解密失败', signature = '$signature', timestamp = '$timeStamp', nonce ='$nonce' , encrypt_type = '$encrypt_type', msg_signature = '$msg_sign', raw_msg = '$xmlstr' where id=1";
        $db->insert($sql_mess);
    }
}else{

    $sql_mess = "update data set  component_verify_ticket = 'post数据体为空', signature = '$signature', timestamp = '$timeStamp', nonce ='$nonce' , encrypt_type = '$encrypt_type', msg_signature = '$msg_sign', raw_msg = '$xmlstr' where id=1";
    $db->insert($sql_mess);
}


echo 'success';























//4dda1514bded0b40312e2d41fab4cec1--scret
?>
