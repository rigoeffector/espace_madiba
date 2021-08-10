<?php

/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:PUT');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/book/book.category.php";
$database = new Database();

$db = $database->connect();
$book_cat = new BookCategory($db);


$data = json_decode(file_get_contents("php://input"));
//  check whether id is set or not 
$book_cat->id = $data->id;
$book_cat->title = $data->title;
$book_cat->number_of_books = $data->number_of_books;
$book_cat->languages = $data->languages;
//  prepare data to be sent 
if ($book_cat->update()) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => "Book Category is updated successfully"
    );
    echo json_encode(
        $response
    );
} else {
    $response = array(
        "status" => "error",
        "error" => true, "success" => false,
        "message" => "Book Category is not updated"
    );
    echo json_encode(
        $response
    );
}




// header('Content-Type: application/json; charset=utf-8');
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: PUT, GET, POST");
// $connection = null;
// try {
//     $db_server   = "mysql:dbname=madiba; host=localhost";
//     $user_name   = "Toussaint";
//     $password    = "digitaloceaN@00d";

//     $user_name   = "root";
//     $password    = "";

//     $connection = new PDO($db_server, $user_name, $password);
//     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection Error: " . $e->getMessage();
// }
// $response = array();
// $upload_dir = "upload/";
// $server_url = 'http://127.0.0.1:8000';



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
//     $random_name = rand(1000, 1000000) . "-" . $avatar_name;
//     $upload_name = $upload_dir . strtolower($random_name);
//     $upload_name = preg_replace('/\s+/', '-', $upload_name);

//     if (move_uploaded_file($avatar_tmp_name, $upload_name)) {
//         $db_query = "UPDATE  book_category SET  
//                                   title=:title, number_of_books=:number_of_books,
//                                   languages=:languages WHERE id = :id";

//         $statement = $connection->prepare($db_query);
//         $statement->bindParam(":id", $_POST['id']);
//         $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
//         $statement->bindParam(':number_of_books', $_POST['number_of_books'], PDO::PARAM_STR);
//         $statement->bindParam(':languages', $_POST['languages'], PDO::PARAM_STR);
//         $statement->bindParam(':icon_image', $upload_name, PDO::PARAM_STR);


//         var_dump($_POST['title']);
//         $statement->execute();
//         var_dump($statement->execute());
//         $response = array(
//             "status" => "success",
//             "error" => false,
//             "message" => "Book category is updated successfully",
//             "url" =>  $_POST['title']
//         );
//     } else {
//         $response = array(
//             "status" => "error",
//             "error" => true,
//             "message" => "Error uploading the file!"
//         );
//     }
// }


// echo json_encode($response);
