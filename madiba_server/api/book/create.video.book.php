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
$maxsize = 5242880; // 5MB
if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
    $name = $_FILES['file']['name'];
    $target_dir = "videos/";
    $target_file = $target_dir . $_FILES["file"]["name"];
    // Select file type
    $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Valid file extensions
    $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg");
    // Check extension
    if (in_array($extension, $extensions_arr)) {

        // Check file size
        if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
            $_SESSION['message'] = "File too large. File must be less than 5MB.";
        } else {
            // Upload
            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                // Insert record
                $db_query = "INSERT INTO video_book(title,summary,video_location,user_classesId,user_categoryId,
                auhtor) VALUES (:title,:summary,:video_location,:user_classesId,
                 :user_classesId,:user_categoryId,:auhtor)";

                $statement = $connection->prepare($db_query);
                $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
                $statement->bindParam(':summary', $_POST['summary'], PDO::PARAM_STR);
                $statement->bindParam(':video_location', $_POST['video_location'], PDO::PARAM_STR);
                $statement->bindParam(':user_classesId', $_POST['user_classesId'], PDO::PARAM_STR);
                $statement->bindParam(':user_categoryId', $_POST['user_categoryId'], PDO::PARAM_STR);
                $statement->bindParam(':auhtor', $_POST['auhtor'], PDO::PARAM_STR);
                $statement->execute();
                mysqli_query($con, $query);
                $response = array(
                    "status" => "success",
                    "error" => false,
                    "message" => "Successfully created video",
        
                );
            }
        }
    } else {
        $response = array(
            "status" => "fail",
            "error" => true,
            "message" => "Invalid file extension",

        );
    }
} else {

    $response = array(
        "status" => "fail",
        "error" => true,
        "message" => "Please select a file",

    );
}
