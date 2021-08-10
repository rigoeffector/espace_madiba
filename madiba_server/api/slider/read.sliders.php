<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/sliders/sliders.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserClasses 

$slider_info = new sliders($db);

$result = $slider_info->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $slider_info_arr = array("length"=>$num, "success"=> true);
    $slider_info_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $slider_info_item = array(

            "id" => $id,
            "title" => $title,
            "caption" => $caption,
            "image" => $image	,
            "description" => $description,
           
        );

        // Push to array  

        array_push($slider_info_arr['data'], $slider_info_item);

        // turn it to json mode 


    }
    echo json_encode($slider_info_arr);
} else {
    $response = array(
        "status" => "success",
        "data"=>[],
        "error" => false,
        "message" => "No sliders  Found"
    );
    echo  json_encode(
        $response
    );
}
