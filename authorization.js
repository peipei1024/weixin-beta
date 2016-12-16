/**
 * Created by Administrator on 2016/12/15.
 */
// https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID
// &redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect

var appid = 'wx3f69126e35cab2ed';
var redirect_uri = 'https://www.pxz1004.cn/callback.php';

var url = 'https://pen.weixin.qq.com/connect/oauth2/authorize?appid=' + appid + '&redirect_uri='
    + encodeURI(redirect_uri) + '&response_type=code&scope=snsapi_userinfo&state=aa#wechat_redirect';
