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
include_once "../../models/book/book.php";
$database = new Database();

$db = $database->connect();
$book = new BookInformation($db);


$data = json_decode(file_get_contents("php://input"));
//  check whether id is set or not 
$book->id = $data->id;
$book->title = $data->title;
$book->numbers = $data->numbers;
$book->authors = $data->authors;
$book->summary = $data->summary;
$book->languages = $data->languages;

//  prepare data to be sent 
if ($book->updateBook()) {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => "Book  is updated successfully"
    );
    echo json_encode(
        $response
    );
} else {
    $response = array(
        "status" => "error",
        "error" => true, "success" => false,
        "message" => "Book  is not updated"
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
//     $password    = "123456789";

//     $connection = new PDO($db_server, $user_name, $password);
//     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection Error: " . $e->getMessage();
// }
// $response = array();
// $upload_dir = "upload/";
// $server_url = 'http://127.0.0.1:8000';

// if (
//     !empty($_POST['title'])
// ) {

//     $avatar_name = $_FILES["avatar"]["name"];
//     $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
//     $error = $_FILES["avatar"]["error"];

//     if ($error > 0) {
//         $response = array(
//             "status" => "error",
//             "error" => false,
//             "message" => "Error uploading the file!",
            
//         );
//     } else {
//         $random_name = rand(1000, 1000000) . "-" . $avatar_name;
//         $upload_name = $upload_dir . strtolower($random_name);
//         $upload_name = preg_replace('/\s+/', '-', $upload_name);

//         if (move_uploaded_file($avatar_tmp_name, $upload_name)) {
//             $db_query = "UPDATE  book SET 
//                               title=:title,numbers=:numbers,authors=:authors,image=:image,
//                               summary=:summary,book_categoryId=:book_categoryId,
//                               user_classesId=:user_classesId,isAvailable=:isAvailable 
//                               WHERE id=:id";

//             $statement = $connection->prepare($db_query);
//             $statement->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
//             $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
//             $statement->bindParam(':numbers', $_POST['numbers'], PDO::PARAM_STR);
//             $statement->bindParam(':authors', $_POST['authors'], PDO::PARAM_STR);
//             $statement->bindParam(':image', $avatar_name, PDO::PARAM_STR);
//             $statement->bindParam(':summary', $_POST['summary'], PDO::PARAM_STR);
//             $statement->bindParam(':book_categoryId', $_POST['book_categoryId'], PDO::PARAM_STR);
//             $statement->bindParam(':user_classesId', $_POST['user_classesId'], PDO::PARAM_STR);
//             $statement->bindParam(':isAvailable', $_POST['isAvailable'], PDO::PARAM_STR);

//             $statement->execute();
//             $response = array(
//                 "status" => "success",
//                 "error" => false,
//                 "message" => "File uploaded successfully",
//                 "url" => $server_url . "/" . $upload_name
//             );
//         } else {
//             $response = array(
//                 "status" => "error",
//                 "error" => true,
//                 "message" => "Error uploading the file!",
//                 "data"=>$_POST['title']
//             );
//         }
//     }
// } else {
//     $response = array(
//         "status" => "error",
//         "error" => true,
//         "message" => "No Image profile uploaded"
//     );
// }


// echo json_encode($response);
