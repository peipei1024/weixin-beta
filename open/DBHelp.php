<?php

/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/23
 * Time: 16:14
 * Describe: php执行完成后会自动关闭mysql连接
 */
class DBHelp
{

    private $servser_name = 'localhost';
    private $username;
    private $password;
    private $database_name;
    public function __construct($username, $password, $database)
    {
        $this->username = $username;
        $this->password = $password;
        $this->database_name = $database;
        $this->conn();
    }

    public function conn(){
        $conn = mysql_connect($this->servser_name, $this->username, $this->password) or die("error connecting");
        mysql_query("set names 'utf8'");
        mysql_select_db($this->database_name);
        return $conn;
    }

    public function insert($sql){
        $reslut = mysql_query($sql);
        if (! $reslut){
            return false;
//            die('Could not enter data: ' . mysql_error());
        }else{
            return true;
        }
    }
    public function closeDB($conn = null){
        return mysql_close($conn);
    }

}