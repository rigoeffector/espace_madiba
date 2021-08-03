<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:PUT');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/user/user_register.php";
$database = new Database();

$db = $database->connect();
$user = new UserRegister($db);


$data = json_decode(file_get_contents("php://input"));
//  check whether id is set or not 

$user->phone = $data->phone;
$user->suscriptionId = $data->suscriptionId;
$user->status = $data->status;
$user->transaction_id = $data->transaction_id;
//  prepare data to be sent 
if ($user->updatePaymnentStatus($data->phone)) {
    $user->paymentHistory($data->phone, $data->amount, $data->suscriptionId, $data->status, $data->transaction_id);
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => "membership payment is paid successfully"
    );
    echo json_encode(
        $response
    );
} else {
    $response = array(
        "status" => "error",
        "error" => true, "success" => false,
        "message" => "membership payment is not paid successfully"
    );
    echo json_encode(
        $response
    );
}
