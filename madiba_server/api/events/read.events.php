<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/events/events.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserClasses 

$event_info = new Events($db);

$result = $event_info->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $event_info_arr = array("length"=>$num, "success"=> true);
    $event_info_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $event_info_item = array(

            "id" => $id,
            "title" => $title,
            "description" => $description,
            "categoryId" => $categoryId	,
            "image" => $image	,
            "location" => $location	,
            "time"=>$time,
            "category" => $category	,
            "date" => $date	,
            "is_free" => $is_free	,
            "price" => $price	,
            "available_places" => $available_places	,
        );

        // Push to array  

        array_push($event_info_arr['data'], $event_info_item);

        // turn it to json mode 


    }
    echo json_encode($event_info_arr);
} else {
    echo  json_encode(
        array("message" => "No  Events Found ")
    );
}
