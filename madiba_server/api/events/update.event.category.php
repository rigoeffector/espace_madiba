<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:PUT');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/events/event_category.php";
$database = new Database();


$db = $database->connect();
$eventCat = new EventsCategory($db);


$data = json_decode(file_get_contents("php://input"));
//  check whether id is set or not 

//  prepare data to be sent 
$eventCat->id = $data->id;
$eventCat->title = $data->title;


if ($eventCat->update()) {
    echo json_encode(
        array(
            "message" => "event category updated succcessfully"
        )
    );
} else {
    echo json_encode(
        array(
            "message" => "Failed to Update event class"
        )
    );
}
