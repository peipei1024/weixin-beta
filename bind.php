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
$msg_signature = $_GET['msg_signature'];
$timetamp = $_GET['timetamp'];
$nonce = $_GET['nonce'];
$encrypt_type =$_GET['encrypt_type'];
$encryptMsg = file_get_contents('php://input');


$mysql_server_name='localhost'; //改成自己的mysql数据库服务器

$mysql_username='root'; //改成自己的mysql数据库用户名

$mysql_password='1130397686p'; //改成自己的mysql数据库密码

$mysql_database='weixinopen'; //改成自己的mysql数据库名

$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ;
//连接数据库


mysql_query("set names 'utf8'"); //数据库输出编码

mysql_select_db($mysql_database); //打开数据库
$timemmm = date("h:i:sa");
$s = "insert into data (name,content) values ('zansan', 'zansan')";


mysql_query($s);


$token = 'weixin';
$encodingAesKey = 'tCEyXIG0Z1P1HL7DlmSfZ6rKjv8K8GVBbTZdhJe7RIc';
$appId = 'wx92fc526e3db0b962';
$wx = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
$xml_tree = new DOMDocument();
$xml_tree->loadXML($encryptMsg);
$array_e = $xml_tree->getElementsByTagName('Encrypt');
$encrypt = $array_e->item(0)->nodeValue;

$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";

$from_xml = sprintf($format, $encrypt);

$msg = '';

$errCode = $wx->decryptMsg($msg_signature, $timeStamp, $nonce, $from_xml, $msg);

if ($errCode == 0) {

    $xml = new DOMDocument();
    $xml->loadXML($msg);
    $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');

    $component_verify_ticket = $array_e->item(0)->nodeValue;
    $sq = "insert into data (name,content) values ('ticket', $component_verify_ticket)";
    mysql_query($sq);



    echo "success";

}
mysql_close();



























?>
