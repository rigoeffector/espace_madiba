<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/user/user_register.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserCategory 

$history_info = new UserRegister($db);

$result = $history_info->readHistory();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $history_info_arr = array();
    $history_info_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $history_info_item = array(

            "id" => $id,
           
            "amount" => $amount,
            "suscriptionId" => $suscriptionId,
            "transaction_id" => $transaction_id,
            "created_time" => $created_time,
            "transaction_id" => $transaction_id,
            "userCategoryTitle" => $userCategoryTitle,
            "suscriptionFees" => $suscriptionFees,
            "subscriptionDescription" => $subscriptionDescription,
            "fname" => $fname,
            "lname" => $lname,
            "address" => $address,
            "phone" => $phone,
            "isMembershipPaid" => $isMembershipPaid == "0" ?"Not paid"  : "Paid",
        );

        // Push to array  

        array_push($history_info_arr['data'], $history_info_item);

        // turn it to json mode 


    }
    echo json_encode($history_info_arr);
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
