<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/admin/admin.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserClasses 

$admin = new Login($db);

$result = $admin->read();

// get Row Count 


$num = $result->rowCount();
$admin_arr = array();
if ($num > 0) {
    
    $admin_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $admin_item = array(

            "id" => $id,
            "username" => $username,
            "password" => $password,
            "image" => $image
         
        );

        // Push to array  

        array_push($admin_arr['data'], $admin_item);

        // turn it to json mode 


    }
    echo json_encode($admin_arr);
} else {
    $response = array(
        "status" => "success",
        "data"=>[],
        "error" => false,
        "message" => "No Admin  Found"
    );
    echo  json_encode(
        $response 
    );
}
