<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/05/2021
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:POST');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/user/user_class.php";


$database = new Database();
$db = $database->connect();
$user_class = new UserClasses($db);



$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$user_class->title = $data->title;
$user_class->user_categoryId = $data->user_categoryId;
$user_class->created_time = date("Y/m/d");
$user_class->age_range = $data->age_range;
$user_class->number_of_per_week = $data->number_of_per_week;
$user_class->number_of_per_month = $data->number_of_per_month;
if ($user_class->create($data->title,$data->age_range,$data->user_categoryId)) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " user class is saved successfully"
    );
    echo json_encode(
        $response
    );
} 
