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
include_once "../../models/events/event_category.php";


$database = new Database();
$db = $database->connect();
$event_category = new EventsCategory($db);



$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$event_category->title = $data->title;
if ($event_category->create($data->title)) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => "Event Category is saved successfully"
    );
    echo json_encode(
        $response
    );
}
