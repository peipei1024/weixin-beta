<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/22
 * Time: 12:06
 * Describe:
 */
$mysql_server_name='localhost';

$mysql_username='root';

$mysql_password='1130397686p';

$mysql_database='weixinopen';

$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ;

mysql_query("set names 'utf8'");

mysql_select_db($mysql_database);

$sql_mess = "insert into data (name,content) values ('file_signature', 'fbf38fc09451e9c0d77017fdf978e1feed67fb34')";
mysql_query($sql_mess);
mysql_close();
echo 'success';
