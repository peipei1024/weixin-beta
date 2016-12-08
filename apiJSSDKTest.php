<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/8
 * Time: 16:29
 * Describe:
 */
require_once "JSSDK.php";
$jssdk = new JSSDK('wx3f69126e35cab2ed', '5610953c67d15e184c9af9b53511f1fb');
$signPackage = $jssdk->getSignPackage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: true,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: '<?php echo $signPackage["timestamp"];?>',
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'checkJsApi',
            'openLocation',
            'getLocation',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'getNetworkType',
            'previewImage'
        ]
    });
    wx.ready(function () {
        wx.openLocation({
            latitude: 23.099994,
            longitude: 113.324520,
            name: 'TIT 创意园',
            address: '广州市海珠区新港中路 397 号',
            scale: 14,
            infoUrl: 'http://weixin.qq.com'
        });
    });
//    wx.checkJsApi({
//        jsApiList: [
//            'getNetworkType',
//            'previewImage'
//        ],
//        success: function (res) {
//            alert('check-api'.JSON.stringify(res));
//        }
//    });
</script>
</html>