<?php
//include "Databaseclass.php";
include  "Users.php";
require_once 'Databaseclass.php';

function registration($firstnamer, $lastnamer, $usernamer, $passwordr){
    $database = new Databaseclass();
    $db = $database->getConnection();
    $user = new Users($db);

    if (checkUserExists($usernamer)){

    }
    else {
        $user->firstname = $firstnamer;
        $user->lastname = $lastnamer;
        $user->username = $usernamer;
        $user->password = md5($passwordr);

// create the product
        if ($user->insert_into()) {
            echo "Registration SUCCESS";
        } else {
            echo "Registration FAIL";
        }
    }
}

function login($enteredEmail,$enteredPassword){
    $database = new Databaseclass();
    $db = $database->getConnection();

    $user = new Users($db);
    $pass=$user->search($enteredEmail);
    if (checkUserExists($enteredEmail) && $pass===md5($enteredPassword)){
        echo "Success";
    }
    else {
        echo "Fail";
    }
}

function ForgetPassword($enteredEmail, $enteredPassword){
    //send email url for reset password
    $database = new Databaseclass();
    $db = $database->getConnection();
    $user = new Users($db);

    $user->password=md5($enteredPassword);
    $user->username=$enteredEmail;

    if($user->update()){
        echo 'Password changed';
    }
    else{
        echo 'THERE IS NO changes';
    }
}

function checkUserExists($checkedEmail){
    $user = new Users();
    $stmt = $user->search_email($checkedEmail);

    if ($stmt>0){
        return true;
    }
    else {
        return false;
    }
}
