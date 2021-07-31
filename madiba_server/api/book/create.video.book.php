<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
$connection = null;
try {
    $db_server   = "mysql:dbname=madiba; host=localhost";
    $user_name   = "root";
    $password    = "123456789";

    $connection = new PDO($db_server, $user_name, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}




if (isset($_FILES['my_video'])) {
    $video_name = $_FILES['my_video']['name'];
    $tmp_name = $_FILES['my_video']['tmp_name'];
    $error = $_FILES['my_video']['error'];

    if ($error === 0) {
        $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);

        $video_ex_lc = strtolower($video_ex);

        $allowed_exs = array("mp4", 'webm', 'avi', 'flv');

        if (in_array($video_ex_lc, $allowed_exs)) {

            $new_video_name = uniqid("video-", true) . '.' . $video_ex_lc;
            $video_upload_path = 'videos/' . $new_video_name;
            if (move_uploaded_file($tmp_name, $video_upload_path)) {
                $db_query = "INSERT INTO  video_book
                (title, summary, video_url, user_classesId, user_categoryId, auhtor,bookCategoryId)
                 VALUES (:title,:summary,:video_url,:user_classesId,:user_categoryId,:auhtor,:bookCategoryId
                 )";

                $statement = $connection->prepare($db_query);

                $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $statement->bindParam(':summary', $_POST['summary'], PDO::PARAM_STR);
                $statement->bindParam(':video_url', $new_video_name, PDO::PARAM_STR);
                $statement->bindParam(':user_classesId', $_POST['user_classesId'], PDO::PARAM_INT);
                $statement->bindParam(':user_categoryId', $_POST['user_categoryId'], PDO::PARAM_INT);
                $statement->bindParam(':auhtor', $_POST['auhtor'], PDO::PARAM_STR);
                $statement->bindParam(':bookCategoryId', $_POST['bookCategoryId'], PDO::PARAM_INT);


                // Now let's Insert the video path into database
                // $sql = "INSERT INTO videos(video_url) 
                //        VALUES('$new_video_name')";
                // mysqli_query($conn, $sql);
                // header("Location: view.php");
                $statement->execute();
                $response = array(
                    "status" => "success",
                    "error" => false,
                    "message" => "video is uploaded successfully",
                );
                echo  json_encode(
                    $response
                );
            } else {
                $response = array(
                    "status" => "error",
                    "data" => [],
                    "error" => true,
                    "message" => "No Video File uploaded, please choose file"
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
        "message" => "No Video File uploaded"
    );
    echo  json_encode(
        $response
    );
}
