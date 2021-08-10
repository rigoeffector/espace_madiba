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

if (isset($_FILES['slider'])) {
    $video_name = $_FILES['slider']['name'];
    $tmp_name = $_FILES['slider']['tmp_name'];
    $error = $_FILES['slider']['error'];

    if ($error === 0) {
        $slider_file = pathinfo($video_name, PATHINFO_EXTENSION);

        $slider_file_lc = strtolower($slider_file);

        $allowed_exs = array("jpeg", 'jpg', 'png');

        if (in_array($slider_file_lc, $allowed_exs)) {

            $new_slider_image = uniqid("slider-", true) . '.' . $slider_file_lc;
            $video_upload_path = 'slider/' . $new_slider_image;
            if (move_uploaded_file($tmp_name, $video_upload_path)) {
                $db_query = "INSERT INTO  sliders
                (title,caption,image,description)
                 VALUES (:title,:caption,:image,:description)";

                $statement = $connection->prepare($db_query);

                $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $statement->bindParam(':caption', $_POST['caption'], PDO::PARAM_STR);
                $statement->bindParam(':image', $new_slider_image, PDO::PARAM_STR);
                $statement->bindParam(':description', $_POST['description'], PDO::PARAM_STR);

                $statement->execute();
                $response = array(
                    "status" => "success",
                    "error" => false,
                    "message" => "slider file is uploaded successfully",
                );
                echo  json_encode(
                    $response
                );
            } else {
                $response = array(
                    "status" => "error",
                    "data" => [],
                    "error" => true,
                    "message" => "No slider file  uploaded, please choose file"
                );
                echo  json_encode(
                    $response
                );
            }
        } else {
            $response = array(
                "status" => "error",
                "error" => true,
                "message" => "You can't upload files of this type",
            );
            echo  json_encode(
                $response
            );
            // header("Location: index.php?error=$em");
        }
    }
} else {
    $response = array(
        "status" => "error",
        "data" => [],
        "error" => true,
        "message" => "No slider File uploaded"
    );
    echo  json_encode(
        $response
    );
}
