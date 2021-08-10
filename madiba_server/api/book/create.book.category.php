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
    !empty($_POST['number_of_books']) &&  !empty($_POST['languages'])

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
        // $connect = mysqli_connect("localhost", "root", "", "madiba");
            $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "duhure");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            };
        $random_name = rand(1000, 1000000) . "-" . $avatar_name;
        $upload_name = $upload_dir . strtolower($random_name);
        $upload_name = preg_replace('/\s+/', '-', $upload_name);

        if (move_uploaded_file($avatar_tmp_name, $upload_name)) {
            $db_query = "INSERT INTO  book_category
                              (title, number_of_books, languages, icon_image,user_classesId)
                               VALUES (:title,:number_of_books,:languages,:icon_image,:user_classesId
                               )";

            $statement = $connection->prepare($db_query);

            $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
            $statement->bindParam(':number_of_books', $_POST['number_of_books'], PDO::PARAM_STR);
            $statement->bindParam(':languages', $_POST['languages'], PDO::PARAM_STR);
            $statement->bindParam(':icon_image', $upload_name, PDO::PARAM_STR);
            $statement->bindParam(':user_classesId', $_POST['user_classesId'], PDO::PARAM_INT);
            $title = $_POST['title'];
            $userclassId = $_POST['user_classesId'];
            $checkName = "select * from book_category where title = '$title' and user_classesId='$userclassId'";
            $rowcount = null;

            
            if ($result = mysqli_query($connect, $checkName)) {
                $rowcount = mysqli_num_rows($result);
                mysqli_free_result($result);
            }

            if ($rowcount > 0) {
                $response = array(
                    "status" => "success",
                    "error" => false, "success" => true,
                    "message" => "you are already saved this category"
                );
                echo json_encode(
                    $response
                );
            } else {

                $statement->execute();
                $response = array(
                    "status" => "success",
                    "error" => false,
                    "message" => "Book category is successfully saved",
                    "url" => $server_url . "/" . $upload_name
                );
                echo json_encode($response);
            }
        } else {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "Error uploading the file or Book category is not successfully saved!"
            );
            echo json_encode($response);
        }
    }
} else {
    $response = array(
        "status" => "error",
        "error" => true,
        "message" => "No Image profile uploaded"
    );
    echo json_encode($response);
}


