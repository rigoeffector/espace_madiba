<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/user/user_category.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserCategory 

$user_category = new UserCategory($db);

$result = $user_category->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $user_category_arr = array();
    $user_category_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_category_item = array(

            "id" => $id,
            "title" => $title,
            "membership_fees" => $membership_fees,
            "description" => $description,
            "created_time" => $created_time
        );

        // Push to array  

        array_push($user_category_arr['data'], $user_category_item);

        // turn it to json mode 


    }
    echo json_encode($user_category_arr);
} else {
    $response = array(
        "status" => "success",
        "data"=>[],
        "error" => false,
        "message" => "No User Category  Found"
    );
    echo  json_encode(
        $response
    );
}
