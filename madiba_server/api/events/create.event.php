<?php

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
$connection = null;
try {
    $db_server   = "mysql:dbname=madiba; host=localhost";
    $user_name   = "Toussaint";
    $password    = "digitaloceaN@00d";

    // $user_name   = "root";
    // $password    = "";

    $connection = new PDO($db_server, $user_name, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}
$response = array();
$upload_dir = "upload/";
$server_url = 'http://127.0.0.1:8000';

if (
    !empty($_POST['title']) &&
    !empty($_POST['description']) &&  !empty($_POST['categoryId'])

) {

    $avatar_name = $_FILES["avatar"]["name"];
    $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
    $error = $_FILES["avatar"]["error"];

    if ($error > 0) {
        $response = array(
            "status" => "error",
            "error" => true,
            "message" => "Error uploading the file!"
        );
    } else {
        $random_name = rand(1000, 1000000) . "-" . $avatar_name;
        $upload_name = $upload_dir . strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        if (move_uploaded_file($avatar_tmp_name, $upload_name)) {
            $db_query = "INSERT INTO  events(title, description, categoryId, image, location, time,date, is_free, price,available_places)
                               VALUES (:title,:description,:categoryId,:image,:location,:time,:date,:is_free,:price,:available_places)";

            $statement = $connection->prepare($db_query);

            $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
            $statement->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
            $statement->bindParam(':categoryId', $_POST['categoryId'], PDO::PARAM_INT);
            $statement->bindParam(':image', $upload_name, PDO::PARAM_STR);
            $statement->bindParam(':location', $_POST['location'], PDO::PARAM_STR);
            $statement->bindParam(':time', $_POST['time'], PDO::PARAM_STR);
            $statement->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
            $statement->bindParam(':is_free', $_POST['is_free'], PDO::PARAM_INT);
            $statement->bindParam(':price', $_POST['price'], PDO::PARAM_STR);
            $statement->bindParam(':available_places', $_POST['available_places'], PDO::PARAM_STR);

            $statement->execute();
            $response = array(
                "status" => "success",
                "error" => false,
                "message" => "Event is successfully saved",
                "url" => $server_url . "/" . $upload_name
            );
        } else {
            print_r("Error:%s.\n", $statement->error);
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file!"
            );
        }
    }
} else {
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No Image profile uploaded"
    );
}

echo json_encode($response);
