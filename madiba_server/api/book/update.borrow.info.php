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
$borrow_info = new BookInformation($db);



$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$borrow_info->userId = $data->userId;
$borrow_info->bookId = $data->bookId;
$borrow_info->status = $data->status;
$borrow_info->return_date = date("y-m-d");
if ($borrow_info->updateBorrowInfo($data->bookId,$data->userId)) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " User Borrow book info updated successfully"
    );
    echo json_encode(
        $response
    );
} 
