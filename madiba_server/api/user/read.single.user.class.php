<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/user/user_class.php";

$database = new Database();
$db = $database->connect();
$user_class = new UserClasses($db);




$user_class->id = isset($_GET['id']) ? $_GET['id'] : die();
if (!NULL == $user_class->id) {
    $user_class->readSingleCategory();
    $user_class_arr =  array(
        "id" => $user_class->id,
        "title" => $user_class->title,
        "membership_fees" => $user_class->membership_fees,
        "number_of_per_week" => $user_class->number_of_per_week,
        "number_of_per_month" => $user_class->number_of_per_month,
    );

    // extract as jsons 
    print_r(json_encode($user_class_arr));
} else {
    echo json_encode(
        array(
            "message" => "Id is not Match"
        )
    );
 
    return;
}
