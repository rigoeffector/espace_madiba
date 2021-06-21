<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/book/book.category.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserRegister

$book_cat = new BookCategory($db);

$result = $book_cat->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $book_cat_arr = array();
    $book_cat_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $book_cat_item = array(

            "id" => $id,
            "title" => $title,
            "number_of_books" => $number_of_books,
            "languages" => $languages,
            "userClass"=>$userClass,
            "age_range"=>$age_range,
            "icon_image" => $icon_image,
            "created_time" => $created_time,


        );

        // Push to array  

        array_push($book_cat_arr['data'], $book_cat_item);

        // turn it to json mode 


    }
    echo json_encode($book_cat_arr);
} else {
    $response = array(
        "status" => "error",
        "data"=>[],
        "error" => false,
        "message" => "No Book Category  Found"
    );
    echo  json_encode(
        $response
    );
}
