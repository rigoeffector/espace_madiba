<?php

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
$connection = null;
try {
    $db_server   = "mysql:dbname=madiba; host=localhost";
    $user_name   = "root";
    $password    = "";
    // $user_name   = "Toussaint";
    // $password    = "digitaloceaN@00d";

    $connection = new PDO($db_server, $user_name, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}
$response = array();
$upload_dir = "upload/";
$server_url = 'http://127.0.0.1:8000';

if (
    !empty($_POST['fname']) &&
    !empty($_POST['fname'])
    && !empty($_POST['lname']
        && !empty($_POST['address'])) &&
    !empty($_POST['phone'])
) {

    // $avatar_name = $_FILES["avatar"]["name"];
    // $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
    // $error = $_FILES["avatar"]["error"];

    // if ($error > 0) {
    //     $response = array(
    //         "status" => "error",
    //         "error" => true,
    //         "message" => "Error uploading the file!"
    //     );
    // } else {
    // $random_name = rand(1000, 1000000) . "-" . $avatar_name;
    // $upload_name = $upload_dir . strtolower($random_name);
    // $upload_name = preg_replace('/\s+/', '-', $upload_name);

    // if (move_uploaded_file($avatar_tmp_name, $upload_name)) {
         $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "madiba");
          
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $stmt = $connection->query("select * from registartion_users where phone = '$phone' OR email='$email'");
    $row_count = $stmt->rowCount();

    if ($rowcount > 0) {
        $response = array(
            "status" => "success",
            "error" => false, "success" => true,
            "message" => "you are already created an account with this phone or email address"
        );
        echo json_encode(
            $response
        );
    } else {
       
        $db_query = "INSERT INTO registartion_users
                (fname, lname, address, phone, user_categoryId,
                 email, password, isMembershipPaid,
                  user_classesId)
                 VALUES (:fname,:lname,:address,:phone,
                 :user_categoryId,:email,:password,
                 :isMembershipPaid,:user_classesId)
  ";

        $statement = $connection->prepare($db_query);

        $statement->bindParam(':fname', $_POST['fname'], PDO::PARAM_STR);
        $statement->bindParam(':lname', $_POST['lname'], PDO::PARAM_STR);
        $statement->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
        $statement->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
        $statement->bindParam(':user_categoryId', $_POST['user_categoryId'], PDO::PARAM_STR);
        $statement->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $statement->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
        // $statement->bindParam(':image', $upload_name, PDO::PARAM_STR);
        $statement->bindParam(':isMembershipPaid', $_POST['isMembershipPaid'], PDO::PARAM_STR);
        $statement->bindParam(':user_classesId', $_POST['user_classesId'], PDO::PARAM_STR);


        $statement->execute();
        $response = array(
            "status" => "success",
            "error" => false,
            "message" => "User info is saved successfully",
            // "url" => $server_url . "/" . $upload_name
        );
        echo json_encode(
            $response
        );

        // } else {
        //     $response = array(
        //         "status" => "error",
        //         "error" => true,
        //         "message" => "Error uploading the file!"
        //     );
        // }
        // }
    }
} else {
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "Fill the form to continue"
    );
    echo json_encode(
        $response
    );
}


