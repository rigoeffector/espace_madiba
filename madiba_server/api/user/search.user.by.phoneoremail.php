<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/user/user_register.php";

$database = new Database();
$db = $database->connect();
$user = new UserRegister($db);
$user->phone = $_GET['phone']? $_GET['phone'] : die();;
 if(!NULL == $user->phone){
    $user->searchPeopleByPhone($user->phone);  
}


   

