<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/events/event_category.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserCategory 

$event_category = new EventsCategory($db);

$result = $event_category->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $event_category_arr = array();
    $event_category_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $event_category_item = array(

            "id" => $id,
            "title" => $title,

        );

        // Push to array  

        array_push($event_category_arr['data'], $event_category_item);

        // turn it to json mode 

    }
    echo json_encode($event_category_arr);
} else {
    $response = array(
        "status" => "success",
        "data"=>[],
        "error" => false,
        "message" => "No Events  Category Found"
    );
    echo  json_encode(
        $response
    );
}
