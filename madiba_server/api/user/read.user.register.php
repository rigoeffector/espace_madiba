<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/user/user_register.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserRegister

$user_register = new UserRegister($db);

$result = $user_register->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $user_register_arr = array();
    $user_register_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_register_item = array(

            "id" => $id,
            "fname" => $fname,
            "lname" => $lname,
            "address" => $address,
            "phone" => $phone,
            "age_range" => $age_range,
            "title" => $title,
            "membership_fees" => $membership_fees,
            "email" => $email,
            "password" => $password,
            "images"=>$image,
            "isMembershipPaid" => $isMembershipPaid,
            "class_title" => $class_title,
            "user_classesIds" => $user_classesIds,
        );

        // Push to array  

        array_push($user_register_arr['data'], $user_register_item);

        // turn it to json mode 


    }
    echo json_encode($user_register_arr);
} else {
    echo  json_encode(
        array("message" => "No User  Found ")
    );
}
