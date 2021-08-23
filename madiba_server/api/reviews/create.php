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
include_once "../../models/reviews/index.php";


$database = new Database();
$db = $database->connect();
$reviews = new Reviews($db);



$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$reviews->userId = $data->userId;
$reviews->bookId = $data->bookId;
$reviews->helpful = $data->helpful;
$reviews->age_range = $data->age_range;
$reviews->description = $data->description;
if ($reviews->createReview()) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " book review is  saved successfully"
    );
    echo json_encode(
        $response
    );
} 
