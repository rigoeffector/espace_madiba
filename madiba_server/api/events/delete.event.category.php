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
include_once "../../models/events/event_category.php";
$database = new Database();
$db = $database->connect();
$event_category = new EventsCategory($db);
$data = json_decode(file_get_contents("php://input"));



//  check whether id is set or not 
$event_category->id = $data->id;
if ($event_category->delete()) {
    echo json_encode(
        array(
            "message" => "event category deleted ducccessfully"
        )
    );
} else {
    echo json_encode(
        array(
            "message" => "Failed to delete event category"
        )
    );
}
