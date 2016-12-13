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
        <li id="getNetworkType">获取网络状态</li>
        <li id="getLocation">获取经纬度</li>
        <li id="openLocation">打开地图</li>
        <li id="closeWindow">关闭窗口</li>
        <li id="hideMenuItems">批量隐藏保护和功能类按钮</li>
        <li id="showMenuItems">批量显示保护和功能类按钮</li>
<!--        <li id="onMenuShareTimeline">onMenuShareTimeline</li>-->
        <li id="chooseImage">选择图片</li>
        <li id="previewImage">预览图片</li>
        <li id="uploadImage">上传图片</li>
        <li id="downloadImage">下载图片</li>
        <li id="scanQRCode">扫描二维码</li>
        <li id="hideOptionMenu">hideOptionMenu</li>
        <li id="showOptionMenu">showOptionMenu</li>
        <li id="hideAllNonBaseMenuItem">隐藏所有非基础按钮接口</li>
        <li id="showAllNonBaseMenuItem">显示所有功能按钮接口</li>
        <li id="startSearchBeacons">startSearchBeacons</li>
<!--        <li id="onMenuShareAppMessage">onMenuShareAppMessage</li>-->
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
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'scanQRCode',
            'hideOptionMenu',
            'showOptionMenu',
            'openProductSpecificView'
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
        $('#hideMenuItems').click(function () {
            wx.hideMenuItems({
                menuList: ['menuItem:readMode',
                'menuItem:share:timeline'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
            });
        });

        $('#showMenuItems').click(function () {
            wx.showMenuItems({
                menuList: ['menuItem:readMode',
                'menuItem:share:timeline']
            });
        });

        $('#onMenuShareTimeline').click(function () {
            wx.onMenuShareTimeline({
                title: '我是分享', // 分享标题
                link: 'http://www.pxz1004.cn/weixin/callback_info.html', // 分享链接
                imgUrl: '', // 分享图标
                success: function () {
                    // 用户确认分享后执行的回调函数
                    alert("成功");
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                    alert('取消');
                }
            });
        });
        $('#chooseImage').click(function () {
            wx.chooseImage({
                count: 1, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    location.href = 'callback_info.html?localIds=' + localIds;
                }
            });
        });
        $('#previewImage').click(function () {
            wx.previewImage({
                current: 'http://ac-wybixxjv.clouddn.com/EQUAmnJd78stxrRqYmEKuDbpevh3XOhqIh3aLoa5', // 当前显示图片的http链接,不知道显示到哪了
                urls: ['http://ac-wybixxjv.clouddn.com/3r4dONqOsWkDphERhUMLbr3XDqbdVFsamg4YQd7n', 'http://ac-wybixxjv.clouddn.com/PYsNxMZIywJBexDgxxahyDOEu6Toiospj6Szi25E'] // 需要预览的图片http链接列表
            });
        });
        $('#uploadImage').click(function () {
            wx.chooseImage({
                count: 1, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    wx.uploadImage({
                        localId: localIds.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得,必须转tostring，大坑
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            var serverId = res.serverId; // 返回图片的服务器端ID
                            alert(serverId);
                        }
                    });
                }
            });
        });
        $('#downloadImage').click(function () {
            wx.chooseImage({
                count: 1, // 默认9
                sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                success: function (res) {
                    var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                    wx.uploadImage({
                        localId: localIds.toString(), // 需要上传的图片的本地ID，由chooseImage接口获得,必须转tostring，大坑
                        isShowProgressTips: 1, // 默认为1，显示进度提示
                        success: function (res) {
                            var serverId = res.serverId; // 返回图片的服务器端ID
                            wx.downloadImage({
                                serverId: serverId.toString(), // 需要下载的图片的服务器端ID，由uploadImage接口获得
                                isShowProgressTips: 1, // 默认为1，显示进度提示
                                success: function (res) {
                                    var localId = res.localId; // 返回图片下载后的本地ID
                                    alert(res.localId);
                                }
                            });
                        }
                    });
                }
            });
        });
        $('#onMenuShareAppMessage').click(function () {
            wx.onMenuShareAppMessage({
                title: '题目', // 分享标题
                desc: '这里是描述', // 分享描述
                link: '', // 分享链接
                imgUrl: '', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                trigger: function (res) {
                    alert('用户点击发送给朋友');
                },
                success: function (res) {
                    alert('已分享');
                },
                cancel: function (res) {
                    alert('已取消');
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        });
        $('#scanQRCode').click(function () {
            wx.scanQRCode({
                needResult: 0, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                scanType: ["qrCode","barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                success: function (res) {
                    var result = res.resultStr; // 当needResult 为 1 时，扫码返回的结果
                }
            });
        });
        $('#hideOptionMenu').click(function () {
            wx.hideOptionMenu();
        });
        $('#showOptionMenu').click(function () {
            wx.showOptionMenu();
        });
        $('#hideAllNonBaseMenuItem').click(function () {
            wx.hideAllNonBaseMenuItem();
        });
        $('#showAllNonBaseMenuItem').click(function () {
            wx.showAllNonBaseMenuItem();
        });
        $('#startSearchBeacons').click(function () {
            wx.startSearchBeacons({
                ticket:"美食",  //摇周边的业务ticket, 系统自动添加在摇出来的页面链接后面
                complete:function(argv){
                    //开启查找完成后的回调函数
                    alert(argv.length);
                }
            });
        });

    });
    wx.error(function (res) {
        alert(res.errMsg);
    });


</script>
</html>