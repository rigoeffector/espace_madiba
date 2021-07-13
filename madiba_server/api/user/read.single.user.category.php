<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/user/user_category.php";

$database = new Database();
$db = $database->connect();
$user_cat = new UserCategory($db);




$user_cat->id = isset($_GET['id']) ? $_GET['id'] : die();
if (!NULL == $user_cat->id) {
    $user_cat->readSingleCategory();
    $user_cat_arr =  array(
        "id" => $user_cat->id,
        "title" => $user_cat->title,
        "membership_fees" => $user_cat->membership_fees,
        "created_time" => $user_cat->created_time,
     

    );

    // extract as jsons 
    print_r(json_encode($user_cat_arr));
} else {
    echo json_encode(
        array(
            "message" => "Id is not Match"
        )
    );
 
    return;
}
