<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/events/events.php";

$database = new Database();
$db = $database->connect();
$event = new Events($db);




$event->id = isset($_GET['id']) ? $_GET['id'] : die();
if (!NULL == $event->id) {
    $event->readSingleCategory();
    $event_arr =  array(
        "id" => $event->id,
        "title" => $event->title,
        "description" => $event->description,
        "categoryId" => $event->categoryId,
        "image" => $event->image    ,
        "location" => $event->location,
        "time" => $event->time,
        "category" => $event->category,
        "date" => $event->date,
        "is_free" => $event->is_free,
        "price" => $event->price,
        "available_places" => $event->available_places,
        "status" => $event->status,
       

    );

    // extract as jsons 
    print_r(json_encode($event_arr));
} else {
    echo json_encode(
        array(
            "message" => "Id is not Match"
        )
    );
  
    return;
}
