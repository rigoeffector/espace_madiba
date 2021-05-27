<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Controll-Allow-Origin:*");
header("Content-Type:application/json");

include_once "../../config/Database.php";
include_once "../../models/book/book.php";

$database = new Database();
$db = $database->connect();
$book = new BookInformation($db);




$book->id = isset($_GET['id']) ? $_GET['id'] : die();
if(!NULL == $book->id){
    $book->readSingleBook();
    $book_arr =  array(
        "id"=>$book->id,
        "title" => $book->title,
        "numbers"=>$book->numbers,
        "authors"=>$book->authors,
        "image" =>$book->image,
        "summary"=>$book->summary,
        "languages"=>$book->languages,
        "book_category"=>$book->book_category,
        "number_of_books"=>$book->number_of_books,
        "thisBookIsAvailable"=>$book->thisBookIsAvailable,
        "user_class"=>$book->user_class,
        "age_range"=>$book->age_range,
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
    error_log("Error:$%Id does not match .\n",0);
    return;
}
?>