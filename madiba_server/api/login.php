<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../config/Database.php';
include_once '../models/login/login.php';



$database = new Database();
$db = $database->connect();


// instatiate our UserRegister

$login_user = new LoginUserInfo($db);
$email = isset($_GET['email']) ? $_GET['email'] : die();
$password = isset($_GET['password']) ? $_GET['password'] : die();
$result = $login_user->getUserLogin($email,$password);

// get Row Count 


$num = $result->rowCount();


if ($num > 0) {
    $login_user_arr = array();
    $login_user_arr['books'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $login_user_item = array(

            "id" => $id,
            "fname" => $fname,
            "lname" => $lname,
            "address" => $address,
            "phone" => $phone,
            "email" => $email,
            "image" => $image,
            "isMembershipPaid" => $isMembershipPaid,
            "userclass" => $userclass,
            "usercategory"=>$usercategory,
            "age_range"=>$age_range,
            "membership_fees" => $membership_fees,
            "bid" => $bid,
            "booktitle" => $booktitle,
            "numbers" => $numbers,
            "authors" => $authors,
            "image" => $image,
            "summary" => $summary,
            "languages" => $languages,
            "isAvailable" => $isAvailable,
           

        );

        // Push to array  
        

        array_push($login_user_arr['books'], $login_user_item);

        // turn it to json mode 


    }
    echo json_encode($login_user_arr);
} else {
    $response = array(
        "status" => "error",
        "data"=>[],
        "error" => false,
        "message" => "No user info  Found"
    );
    echo  json_encode(
        $response
    );
}
