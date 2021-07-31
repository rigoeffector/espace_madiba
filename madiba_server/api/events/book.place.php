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
include_once "../../models/events/events.php";


$database = new Database();
$db = $database->connect();
$book_places = new Events($db);



$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$book_places->userId = $data->userId;
$book_places->eventId = $data->eventId;
$book_places->place_booked = $data->place_booked;
if ($book_places->bookPlace($data->eventId,$data->place_booked)) {
    $book_places->updatePlace($data->place_booked,$data->eventId);
    $response = array(
        "status" => "success",
        "error" => false,
         "success" => true,
        "message" => "Book event is booked successfully"
    );
    echo json_encode(
        $response
    );
}