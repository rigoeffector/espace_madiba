<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:DELETE');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/book/book.php";
$database = new Database();
$db = $database->connect();
$book_cat = new BookInformation($db);
$data = json_decode(file_get_contents("php://input"));



//  check whether id is set or not 
$book_cat->id = $data->id;
if ($book_cat->delete()) {
    echo json_encode(
        array(
            "message" => "user book deleted ducccessfully"
        )
    );
} else {
    echo json_encode(
        array(
            "message" => "Failed to delete user book"
        )
    );
}
