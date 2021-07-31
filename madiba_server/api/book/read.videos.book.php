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

$result = $book_info->readVideoBook();

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
            "summary" => $summary,
            "video_url" => $video_url,
            "auhtor" => $auhtor,
            "user_classesId" => $user_classesId,
            "user_categoryId" => $user_categoryId,
            "userClassTitle" => $userClassTitle,
            "age_range" => $age_range,
            "userCategoryTitle" => $userCategoryTitle,
            "membership_fees" => $membership_fees,
            "bookCategory" => $bookCategory,
            "number_of_books" => $number_of_books,
            "languages" => $languages,

        );

        // Push to array  

        array_push($book_info_arr['data'], $book_info_item);

        // turn it to json mode 


    }
    echo json_encode($book_info_arr);
} else {
    $response = array(
        "status" => "success",
        "data"=>[],
        "error" => false,
        "message" => "No   Video  Found"
    );
    echo  json_encode(
        $response 
    );
}
