<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/19
 * Time: 10:13
 * Describe:
 */


include_once 'wxBizMsgCrypt.php';
include_once 'DBHelp.php';

$signature    =  $_GET['signature'];
$timeStamp    =  $_GET['timestamp'];
$nonce        =  $_GET['nonce'];
$encrypt_type =  $_GET['encrypt_type'];
$msg_sign     =  $_GET['msg_signature'];
$raw_msg      =  "<?xml version=\"1.0\"?><xml>
    <AppId><![CDATA[wx675ba5140e09984d]]></AppId>
    <Encrypt><![CDATA[rk/pDOtTOhzccUqvPeIhk2Y/eZZR25uUiXBOUUmAwgr8kEMoIaG/z0Q8s4FEJa5JdFREUYxWLzAZ1O0dWBLS1al4eNTtXBiLyjou5pxEh65R/x4SjyIA9FxV6f1TcGEzm82u5M8TCpPwxgST64FE0vhv4pOBwpUf5VB6Br4p7TDKV/RuSOCySgaArsnPpGEj8670l6C3d5dn5A/7IQDmOsuLyWvsug6//+C89Ole0r+y+t55wvhMjvTyozPkfSIWwj3kSrPPkyndfq+HB3ZSI9Wt3DqjYsfZUN0EBTZ5DjJnV6eanrdQla1EUyZaMX7gYXZqRkIgJiLUA5ZuGcyA3vlVMU9fbaXahVyewFwYkMHuMToJX/KnWPf4Wkoa8FCFJjE4QzDx4SjDdas0JW9kIpQK1ReJcEQD0OXL4RkR3g32dABM5asvh9EhNgdcqM796ut+EDrcLFvzzbCjmjOXUw==]]></Encrypt>
</xml>";
$token = 'weixin';
$encodingAesKey = 'tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc';
$appId = 'wx675ba5140e09984d';




$sql_mess = "insert into data (name,content) values ('signature', '$signature')";
$sql_mess1 = "insert into data (name,content) values ('timeStamp', '$timeStamp')";
$sql_mess2 = "insert into data (name,content) values ('nonce', '$nonce')";
$sql_mess3 = "insert into data (name,content) values ('encrypt_type', '$encrypt_type')";
$sql_mess4 = "insert into data (name,content) values ('msg_sign', '$msg_sign')";
$xml = simplexml_load_string($raw_msg);
$xmlstr = $xml->asXML();
$sql_mess5 = "insert into data (name,content) values ('xmlstr', '$xmlstr')";


//$db = new DBHelp('root', '123456', 'weixin');
//$db->insert($sql_mess);
//$db->insert($sql_mess1);
//$db->insert($sql_mess2);
//$db->insert($sql_mess3);
//$db->insert($sql_mess4);
//$db->insert($sql_mess5);




$wechat = new WXBizMsgCrypt($token, $encodingAesKey, $appId);


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
    echo $errCode;
    if ($errCode == 0) {

        $xml = new DOMDocument();
        $xml->loadXML($msg);
        $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
        $component_verify_ticket = $array_e->item(0)->nodeValue;



        echo $component_verify_ticket;
    }else {
        echo 'raw msg fail' . $errCode;
    }
}else{
    echo 'raw msg null';
}


echo 'success';
























//$signature_data = $_GET['signature'];
//$timestamp = $_GET['timestamp'];
//$nonce = $_GET['nonce'];
//$msg_signature = $_GET['msg_signature'];
//$raw_msg =  file_get_contents('php://input');
//
//$getlength = strval(count($_GET));
//
//$mysql_server_name='localhost';
//
//$mysql_username='root';
//
//$mysql_password='123456';
//
//$mysql_database='weixin';
//
//$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ;
//
//mysql_query("set names 'utf8'");
//
//mysql_select_db($mysql_database);
//
//
//$sql_mess = "insert into data (name,content) values ('mess1', 'mess')";
//$sql_signature = "insert into data (name,content) values ('signature1', $signature_data)";
//$sql_timestamp = "insert into data (name,content) values ('timestamp1', $timestamp)";
//$sql_nonce = "insert into data (name,content) values ('nonce1', $nonce)";
//$sql_msg_signature = "insert into data (name,content) values ('msg_signature1', $msg_signature)";
//$sql_get_length = "insert into data (name,content) values ('getlength', $getlength)";
//
//
//mysql_query($sql_mess);
//mysql_query($sql_signature);
//mysql_query($sql_timestamp);
//mysql_query($sql_nonce);
//mysql_query($sql_msg_signature);
//mysql_query($sql_get_length);
//mysql_close();
//echo 'success';
//4dda1514bded0b40312e2d41fab4cec1--scret
//$token = 'weixin';
//$encodingAesKey = 'tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc';
//$appId = 'wx92fc526e3db0b962';
//$wx = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
//$xml_tree = new DOMDocument();
//$xml_tree->loadXML($encryptMsg);
//$array_e = $xml_tree->getElementsByTagName('Encrypt');
//$encrypt = $array_e->item(0)->nodeValue;
//
//$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
//
//$from_xml = sprintf($format, $encrypt);
//
//$msg = '';
//
//$errCode = $wx->decryptMsg($msg_signature, $timetamp, $nonce, $from_xml, $msg);
//
//if ($errCode == 0) {
//
//    $xml = new DOMDocument();
//    $xml->loadXML($msg);
//    $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
//
//    $component_verify_ticket = $array_e->item(0)->nodeValue;
//    $sq = "insert into data (name,content) values ('ticket', $component_verify_ticket)";
//    mysql_query($sq);
//
//
//
//    echo "success";
//
//}




//http://www.pxz1004.cn/open/bind.php
//gh_70c737d7be73
//www.pxz1004.cn
//
//weixin
//tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc
//http://www.pxz1004.cn/open/$APPID$/mess.php
//www.pxz1004.cn
//123.206.75.86
//10.07



















?>
