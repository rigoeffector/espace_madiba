<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/events/event_category.php";

$database = new Database();
$db = $database->connect();
$event_cat = new EventsCategory($db);




$event_cat->id = isset($_GET['id']) ? $_GET['id'] : die();
if (!NULL == $event_cat->id) {
    $event_cat->readSingleCategory();
    $event_cat_arr =  array(
        "id" => $event_cat->id,
        "title" => $event_cat->title,
       

    );

    // extract as jsons 
    print_r(json_encode($event_cat_arr));
} else {
    echo json_encode(
        array(
            "message" => "Id is not Match"
        )
    );
    
    return;
}
