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
$video = new BookInformation($db);
$data = json_decode(file_get_contents("php://input"));



//  check whether id is set or not 
$video->id = $data->id;
if ($video->deleteVideo()) {
    echo json_encode(
        array(
            "message" => "video book deleted successfully"
        )
    );
} else {
    echo json_encode(
        array(
            "message" => "Failed to delete video book"
        )
    );
}
