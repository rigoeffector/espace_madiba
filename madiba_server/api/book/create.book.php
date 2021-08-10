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
$server_url = 'https://madiba.isoko250.com/';

if (
    !empty($_POST['title'])
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
            // $connect = mysqli_connect("localhost", "root", "", "madiba");
            $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "duhure");
            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            };

            $title = $_POST['title'];
            $author = $_POST['authors'];
            $userclassId = $_POST['user_classesId'];
            $checkName = "select * from book where title = '$title' and authors='$author'";
            // $rowcount = null;


            if ($result = mysqli_query($conn, $checkName)) {
                $rowcount = mysqli_num_rows($result);
                mysqli_free_result($result);
            }
            
            var_dump($result);
            if ($rowcount > 0) {
                // var_dump($rowcount);
                $response = array(
                    "status" => "success",
                    "error" => false, "success" => true,
                    "message" => "you are already saved this book"
                );
                echo json_encode(
                    $response
                );
            } else {
                $db_query = "INSERT INTO book
                (title, numbers, authors, image, summary, languages,
                book_categoryId, user_classesId, isAvailable)
                 VALUES (:title,:numbers,:authors,:image,
                 :summary,:languages,:book_categoryId,:user_classesId,:isAvailable)";

                $statement = $connection->prepare($db_query);

                $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $statement->bindParam(':numbers', $_POST['numbers'], PDO::PARAM_STR);
                $statement->bindParam(':authors', $_POST['authors'], PDO::PARAM_STR);
                $statement->bindParam(':image', $upload_name, PDO::PARAM_STR);
                $statement->bindParam(':summary', $_POST['summary'], PDO::PARAM_STR);
                $statement->bindParam(':languages', $_POST['languages'], PDO::PARAM_STR);
                $statement->bindParam(':book_categoryId', $_POST['book_categoryId'], PDO::PARAM_STR);
                $statement->bindParam(':user_classesId', $_POST['user_classesId'], PDO::PARAM_STR);
                $statement->bindParam(':isAvailable', $_POST['isAvailable'], PDO::PARAM_STR);


                
                $statement->execute();
                $response = array(
                    "status" => "success",
                    "error" => false,
                    "message" => "File uploaded successfully and book info is saved ",
                    "url" => $server_url . "/" . $upload_name,
                    "result"=>var_dump($result)
                );
                echo json_encode(
                    $response
                );
            }
        } else {
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
