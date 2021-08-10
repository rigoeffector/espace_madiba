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
$book_info->book_categoryId = $data->book_categoryId;
$book_info->age_range = $data->age_range;


$result = $book_info->getAudioByCategoryandAge( $data->book_categoryId,$data->age_range);

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
            "audio_url" => $audio_url,
            "author" => $author,
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
    $response = array(
        "status" => "success",
        "success" => true,
        "message" => "Audio Books fetched",
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
        "message" => "No   Audio  Found"
    );
    echo  json_encode(
        $response 
    );
}
