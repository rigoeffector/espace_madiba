<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/user/user_class.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserClasses 

$user_class = new UserClasses($db);

$result = $user_class->read();

// get Row Count 


$num = $result->rowCount();
$user_class_arr = array();
if ($num > 0) {
    
    $user_class_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_class_item = array(

            "id" => $id,
            "classe_title" => $classe_title,
            "user_category_id" => $user_category_id,
            "user_category_title" => $user_category_title,
            "membership_fees" => $membership_fees,
            "age_range" => $age_range,
        );

        // Push to array  

        array_push($user_class_arr['data'], $user_class_item);

        // turn it to json mode 


    }
    echo json_encode($user_class_arr);
} else {
    echo  json_encode(
        array("message" => "No User Class Found ")
    );
}
