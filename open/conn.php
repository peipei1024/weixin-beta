<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/19
 * Time: 15:25
 * Describe:
 */

require_once 'DBHelp.php';

$db = new DBHelp('root', '123456', 'weixin');
$db->insert("insert into data (name,content) values ('tset','1233455')");
$re = $db->closeDB();

//$mysql_server_name='localhost'; //改成自己的mysql数据库服务器
//
//$mysql_username='root'; //改成自己的mysql数据库用户名
//
//$mysql_password='1130397686p'; //改成自己的mysql数据库密码
//
//$mysql_database='weixinopen'; //改成自己的mysql数据库名
//
//$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ;
////连接数据库
//
//
//mysql_query("set names 'utf8'"); //数据库输出编码
//
//mysql_select_db($mysql_database); //打开数据库
//
//$sql = "insert into data (name,content) values ('zhang','1233455')";
//
//mysql_query($sql);
//
//mysql_close(); //关闭MySQL连接
echo $re;

?>