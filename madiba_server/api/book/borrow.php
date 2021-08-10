<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/05/2021
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:POST');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/book/book.php";


$database = new Database();
$db = $database->connect();
$book = new BookInformation($db);



$data = json_decode(file_get_contents("php://input"));
//  prepare data to be sent
$book->bookId = $data->bookId;
$book->number_of_book_borrowed = $data->number_of_book_borrowed;
$book->userId = $data->userId;
$book->return_date = date($data->return_date);
if ($book->borrowBook($data->bookId,$data->number_of_book_borrowed)) {
    $book->updateNumberOfBooks($data->number_of_book_borrowed,$data->bookId);
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " Book is borrowed successfully"
    );
    echo json_encode(
        $response
    );
} 
