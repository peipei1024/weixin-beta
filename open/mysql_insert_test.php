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

$mysql_password='root';

$mysql_database='weixin';

$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ;

mysql_query("set names 'utf8'");

mysql_select_db($mysql_database);

$sql_mess = "insert into data (name,content) values ('test', 'test')";
mysql_query($sql_mess);
mysql_close();
echo 'success';
