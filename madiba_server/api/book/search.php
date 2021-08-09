<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/book/book.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserClasses 

$book_info = new BookInformation($db);
$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$book_info->keywords = $data->keywords;
$book_info->age_range = $data->age_range;

$result = $book_info->searchBook( $data->keywords,$data->age_range);

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $book_info_arr = array("length" => $num, "success" => true);
    $book_info_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $book_info_item = array(

            "id" => $id,
            "title" => $title,
            "numbers" => $numbers,
            "taken_book" => $taken_book,
            "authors" => $authors,
            "bookCategoryId" => $bookCategoryId,
            "summary" => $summary,
            "languages" => $languages,
            "isAvailable" => $isAvailable,
            "bookCategory" => $bookCategory,
            "bookCategoryId" => $bookCategoryId,
            "userCategory" => $userCategory,
            "userCategoryId" => $userCategoryId,
            

        );

        // Push to array  

        array_push($book_info_arr['data'], $book_info_item);

        // turn it to json mode 


    }
    $response = array(
        "status" => "success",
        "success" => true,
        "message" => " Books fetched",
        "data"=>$book_info_arr['data']
    );
    echo  json_encode(
        $response
    );
} else {
    $response = array(
        "status" => "success",
        "data"=>[],
        "error" => false,
        "message" => "No   Book  Found"
    );
    echo  json_encode(
        $response 
    );
}
