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

$result = $book_info->read();

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
            "taken_book" => $taken_book,
            "authors" => $authors	,
            "image" => $image	,
            "summary" => $summary	,
            "languages"=>$languages,
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
    echo json_encode($book_info_arr);
} else {
    echo  json_encode(
        array("message" => "No  Books Found ")
    );
}
