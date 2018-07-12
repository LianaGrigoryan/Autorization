<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 7/11/2018
 * Time: 12:24 AM
 */

class Databaseclass
{
    private $host = "localhost";
    private $db_name = "logindb";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}