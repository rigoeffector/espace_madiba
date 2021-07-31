<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/book/book.category.php";

$database = new Database();
$db = $database->connect();
$book = new BookCategory($db);




$book->id = isset($_GET['id']) ? $_GET['id'] : die();
if(!NULL == $book->id){
    $book->readSingleBookCat();
    $book_arr =  array(
        "id"=>$book->id,
        "title" => $book->title,
        "number_of_books"=>$book->number_of_books,
        "languages"=>$book->languages,
        "userClass" =>$book->userClass,
        "age_range"=>$book->age_range,
        "icon_image"=>$book->icon_image,
        "userCategory"=>$book->userCategory,
        "created_time"=>$book->created_time,
      
    );
    
    // extract as jsons 
    print_r(json_encode($book_arr));

    
}
else{
    echo json_encode(
        array(
            "message"=>"Id is not Match"
        )
        );
    
    return;
}
