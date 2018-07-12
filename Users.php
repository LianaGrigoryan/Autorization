<?php

include "Databaseclass.php";

class Users
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;

//    public function __construct($db){
//        $this->conn = $db;
//    }

    function insert_into(){
        $db=new Databaseclass();

        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                firstname=:firstname, lastname=:lastname, username=:username, password=:password";

        // prepare query
        $stmt = $db->getConnection()->prepare($query);
        // sanitize
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        // bind values
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function update(){

        $db=new Databaseclass();
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
                password= :password
            WHERE
                username= :username";

        // prepare query statement
        $stmt = $db->getConnection()->prepare($query);

        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));

        // bind new values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);

        // execute the query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    function search_email($keywords){

        $db=new Databaseclass();
        // select all query
        $query = "SELECT
                p.firstname, p.lastname
            FROM
                " . $this->table_name . " p
            WHERE
                p.username LIKE ?";

        // prepare query statement
        $stmt = $db->getConnection()->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);

        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt->rowCount();
    }

    function search($keywords){
    $db=new Databaseclass();
        // select all query
        $query = "SELECT
                p.password
            FROM
                users p
            WHERE
                p.username LIKE ?";

        // prepare query statement
        $stmt = $db->getConnection()->prepare($query);

        // sanitize
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // bind
        $stmt->bindParam(1, $keywords);

        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['password'];
    }
}