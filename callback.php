<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/15
 * Time: 13:29
 * Describe:
 */
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

if (!empty($postStr)) {

    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    echo $postObj->ComponentVerifyTicket;
}
?>
