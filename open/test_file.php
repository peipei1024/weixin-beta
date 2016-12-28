<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/19
 * Time: 15:18
 * Describe:
 */
$url = 'http://www.pxz1004.cn/open/index.html';
echo urlencode($url);

public function actionMsg_receive()
{

    $timeStamp    =  $_GET['timestamp'];
    $nonce        =  $_GET['nonce'];
    $encrypt_type =  $_GET['encrypt_type'];
    $msg_sign     =  $_GET['msg_signature'];
    $raw_msg =  file_get_contents('php://input');

    $encodingAesKey = Yii::$app->params['encodingAesKey'];
    $token = Yii::$app->params['token'];
    $appId = Yii::$app->params['appId'];

    $wechat = new \yii\wxBizMsgCrypt\WXBizMsgCrypt($token, $encodingAesKey, $appId);

    if($raw_msg!=null){
        $encryptMsg=$raw_msg;
        $xml_tree = new \DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;
        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        $msg = '';
        $errCode = $wechat->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);

        if ($errCode == 0) {

            $xml = new \DOMDocument();
            $xml->loadXML($msg);
            $array_e = $xml->getElementsByTagName('ComponentVerifyTicket');
            $component_verify_ticket = $array_e->item(0)->nodeValue;

            Yii::$app->db->createCommand()->update('platfrom_auth_info', [ 'component_verify_ticket' => $component_verify_ticket ],'id=1')->execute();

        } else {
            Yii::$app->db->createCommand()->update('platfrom_auth_info', [ 'component_verify_ticket' => $errCode ],'id=1')->execute();
        }
    }

    echo 'success';
}
