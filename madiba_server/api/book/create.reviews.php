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
include_once "../../models/book/book.php";


$database = new Database();
$db = $database->connect();
$user_class = new BookInformation($db);

$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$user_class->userId = $data->userId;
$user_class->bookId = $data->bookId;
$user_class->description = $data->description;

if ($user_class->reviews()) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " user reviews saved successfully"
    );
    echo json_encode(
        $response
    );
} 
