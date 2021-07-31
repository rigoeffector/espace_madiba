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
include_once "../../models/user/user_category.php";
$database = new Database();
$db = $database->connect();
$user_category = new UserCategory($db);
$data = json_decode(file_get_contents("php://input"));



//  check whether id is set or not 
$user_category->id = $data->id;
if ($user_category->delete()) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => "User category is deleted successfully"
    );
    echo json_encode(
        $response
    );
} else {
    $response = array(
        "status" => "error",
        "error" => true,
         "success" => false,
        "message" => "User category is not deleted? something wrong"
    );
    echo json_encode(
        $response
    );
}
