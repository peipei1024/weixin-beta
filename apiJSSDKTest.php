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
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <link href="apiJSSDKTest.css" rel="stylesheet">
</head>
<body>
    <ul>
        <li id="getNetworkType">getNetworkType</li>
        <li id="getLocation">getLocation</li>
        <li id="openLocation">openLocation</li>
        <li id="closeWindow">closeWindow</li>
        <li id="hideMenuItems">hideMenuItems</li>
    </ul>
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="jquery-3.1.1.js"></script>
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
            'getNetworkType',
            'getLocation',
            'openLocation',
            'closeWindow',
            'hideMenuItems'
        ]
    });

//        wx.checkJsApi({
//            jsApiList: [
//                'openLocation',
//                'openLocation'
//            ],
//            success: function (res) {
//                alert('check-api'.JSON.stringify(res));
//            }
//        });

    wx.ready(function () {
//        js写法
//        document.querySelector('#getNetworkType').onclick = function () {
//            wx.getNetworkType({
//                success : function (res) {
//                    alert('当前网络类型：' + res.networkType);
//                }
//                cancel : function (res) {
//                    alert(JSON.stringify(res));
//                }
//            });
//        };
//        jquery写法
        $('#getNetworkType').click(function () {
            wx.getNetworkType({
               success : function (res) {
                   alert('当前网络类型：' + res.networkType);
               }
            })
        });
        $('#getLocation').click(function () {
            wx.getLocation({
                type: 'wgs84',// 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success : function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    var speed = res.speed; // 速度，以米/每秒计
                    var accuracy = res.accuracy; // 位置精度
                    alert('gps坐标，纬度：' + latitude + '经度：' + longitude + '速度：' + speed +　'位置精度：'　+ accuracy);
                }
            })
        });
        $('#openLocation').click(function () {
            wx.getLocation({
               type: 'gcj02',
                success :　function (res) {
                    var latitude = res.latitude;
                    var longitude = res.longitude;
                    wx.openLocation({
                        latitude: latitude, // 纬度，浮点数，范围为90 ~ -90
                        longitude: longitude, // 经度，浮点数，范围为180 ~ -180。
                        name: '位置名，接口没有这参数', // 位置名
                        address: '详细地址，接口没有这参数-解决方法，调用地图sdk通过经纬度查询', // 地址详情说明
                        scale: 14, // 地图缩放级别,整形值,范围从1~28。默认为最大
                        infoUrl: 'http://www.baidu.com' // 在查看位置界面底部显示的超链接,可点击跳转,没找见这个链接在哪
                    });
                }
            });
        });
        $('#closeWindow').click(function () {
           wx.closeWindow();
        });
//        $('#hideMenuItems').click(function () {
//            wx.hideMenuItems({
//                menuList: [menuItem:share:appMessage, menuItem:openWithSafari] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
//            });
//        });
    });
    wx.error(function (res) {
        alert(res.errMsg);
    });


</script>
</html>