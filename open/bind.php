<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/19
 * Time: 10:13
 * Describe:
 */

//（需传入msg_signature、timetamp、nonce和postdata，前3个参数可从接收已授权公众号消息和事件的URL中获得，postdata即为POST过来的数据包内容）

include_once 'wxBizMsgCrypt.php';

$signature    =  $_GET['signature'];
$timeStamp    =  $_GET['timestamp'];
$nonce        =  $_GET['nonce'];
$encrypt_type =  $_GET['encrypt_type'];
$msg_sign     =  $_GET['msg_signature'];
$raw_msg      =  file_get_contents('php://input');

$token = 'weixin';
$encodingAesKey = 'tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc';
$appId = 'wx92fc526e3db0b962';


$wechat = new WXBizMsgCrypt($token, $encodingAesKey, $appId);



$sql_mess = "insert into data (name,content) values ('component_verify_ticket', 'aa')";
//mysql_query($sql_mess);

$aaaaaa = $signature.'aaa';
$sql_msg_signature = "insert into data (name,content) values ('msg_signature1', $aaaaaa)";


$retval = mysql_query( $sql_msg_signature, $conn );
if(! $retval )
{
//    die('Could not enter data: ' . mysql_error());
}
mysql_close();
$fp = fopen("signature.txt", "w");
fwrite($fp, $signature);
fclose($fp);
$aaa = file_get_contents("signature.txt");
echo $signature;
echo 'success';
echo $aaa;
echo $raw_msg;

//if($raw_msg!=null){
//    $encryptMsg=$raw_msg;
//    $xml_tree = new DOMDocument();
//    $xml_tree->loadXML($encryptMsg);
//    $array_e = $xml_tree->getElementsByTagName('Encrypt');
//    $encrypt = $array_e->item(0)->nodeValue;
//    $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
//    $from_xml = sprintf($format, $encrypt);
//    $msg = '';
//    $errCode = $wechat->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
//
//    if ($errCode == 0) {
//
//        $xml = new DOMDocument();
//        $xml->loadXML($msg);
//        $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
//        $component_verify_ticket = $array_e->item(0)->nodeValue;
//
//        $sql_mess = "insert into data (name,content) values ('component_verify_ticket', $component_verify_ticket)";
//        mysql_query($sql_mess);
//
//    } else {
//        $sql_mess = "insert into data (name,content) values ('component_verify_ticket', 'error')";
//        mysql_query($sql_mess);
//    }
//}else{
//    $sql_mess = "insert into data (name,content) values ('component_verify_ticket', 'nu')";
//    mysql_query($sql_mess);
//}








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
