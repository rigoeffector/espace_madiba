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

$book_info->age_range = isset($_GET['age_range']) ? $_GET['age_range'] : die();
if (!NULL == $book_info->age_range) {
    $result = $book_info->recommendedBooks($book_info->age_range);
    // get Row Count 
    $num = $result->rowCount();
    if ($num > 0) {
        $book_info_arr = array("length" => $num, "success" => true);
        $book_info_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
           
            if($row['totalReviews'] > 15){
                $book_info_item = array(

                    "totalReviews" => $totalReviews,
                    "bookId" => $bookId,
                    "title" => $title,
                    "numbers" => $numbers,
                    "taken_book" => $taken_book,
                    "authors" => $authors,
                    "image" => $image,
                    "summary" => $summary,
                    "languages" => $languages,
                    "book_categoryId" => $book_categoryId,
                    "user_classesId" => $user_classesId,
                    "isAvailable" => $isAvailable,
                    "bookCategory" => $bookCategory,
                    "userClass" => $userClass,
                    "age_range" => $age_range,
    
                );
    
                // Push to array  
    
                array_push($book_info_arr['data'], $book_info_item);
                $response = array(
                    "status" => "success",
                    "data" => $book_info_arr['data'],
                    "error" => false,
                    "message" => "Books founds"
                );
    
                // turn it to json mode 
            }else{
                $response = array(
                    "status" => "success",
                    "data" => $book_info_arr['data'],
                    "error" => false,
                    "message" => "no Books founds"
                ); 
            }
           


        }
        echo  json_encode(
            $response
        );
    } else {
        $response = array(
            "status" => "success",
            "data" => [],
            "error" => false,
            "message" => "no Books founds"
        ); 
        echo  json_encode(
            $response
        );
    }
}
