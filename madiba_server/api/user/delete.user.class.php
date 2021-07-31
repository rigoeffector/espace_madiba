<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:DELETE');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/user/user_class.php";
$database = new Database();
$db = $database->connect();
$user_class = new UserClasses($db);
$data = json_decode(file_get_contents("php://input"));



//  check whether id is set or not 
$user_class->id = $data->id;
if ($user_class->delete()) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => "User class is deleted successfully"
    );
    echo json_encode(
        $response
    );
} else {
    $response = array(
        "status" => "error",
        "error" => true, "success" => false,
        "message" => "User class is not deleted"
    );
    echo json_encode(
        $response
    );
}
