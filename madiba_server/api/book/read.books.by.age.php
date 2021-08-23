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
if(!NULL == $book_info->age_range){

    $result = $book_info->readBooksByAge($book_info->age_range);

    // get Row Count 
    
    $num = $result->rowCount();
    
    if ($num > 0) {
        $book_info_arr = array("length"=>$num, "success"=> true);
        $book_info_arr['data'] = array();
    
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $book_info_item = array(
    
                "id" => $id,
                "title" => $title,
                "numbers" => $numbers,
                "authors" => $authors	,
                "image" => $image	,
                "summary" => $summary	,
                "languages"=>$languages,
                // "userCategory"=>$userCategory,
                "book_category" => $book_category	,
                "number_of_books" => $number_of_books	,
                "thisBookIsAvailable" => $thisBookIsAvailable	,
                "user_class" => $user_class,
                "age_range" => $age_range,
            );
    
            // Push to array  
    
            array_push($book_info_arr['data'], $book_info_item);
    
            // turn it to json mode 
    
    
        }
        $response = array(
            "status" => "success",
            "error" => false, "success" => true,
            "data" => $book_info_arr['data'],
            "message" => "Books fetched successfully"
        );
        echo json_encode(
            $response
        );
    } else {
        $response = array(
            "status" => "success",
            "error" => false, "success" => true,
            "message" => "no book founds "
        );
        echo json_encode(
            $response
        );
    }
    
}
