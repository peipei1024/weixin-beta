<?php
/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/19
 * Time: 10:20
 * Describe:
 */

//$file = fopen("componentverifyticket.txt","r");
//$contents = fread($file,filesize("componentverifyticket.txt"));
//fclose($file);
$contents = file_get_contents("componentverifyticket.txt");

echo $contents.'4444';

//$fp = fopen("componentverifyticket.txt", "w");
//fwrite($fp, $contents);
//fclose($fp);
