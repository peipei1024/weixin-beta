<?php

/**
 * Created by PhpStorm.
 * User: pxz
 * Date: 2016/12/23
 * Time: 16:14
 * Describe:
 */
class DBHelp
{

    private $servser_name = 'localhost';
    private $username;
    private $password;
    private $database_name;
    private $conn;
    public function __construct($username, $password, $database)
    {
        $this->username = $username;
        $this->password = $password;
        $this->database_name = $database;
        $this->conn = mysql_connect($this->servser_name, $this->username, $this->password) or die("error connecting");
        mysql_query("set names 'utf8'");
        mysql_select_db($this->database_name);
    }

    public function insert(){

    }
    public function closeDB(){

    }
}