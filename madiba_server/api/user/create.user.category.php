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
 include_once "../../models/user/user_category.php";


 $database = new Database();
 $db = $database->connect();
 $user_category = new UserCategory($db);



 $data= json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$user_category->title = $data->title;
$user_category->membership_fees =$data->membership_fees;
$user_category->description =$data->description;
$user_category->created_time =date("Y/m/d");


if($user_category->create($data->title)){
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " Subscription saved successfully"
    );
    echo json_encode(
        $response
    );
}

