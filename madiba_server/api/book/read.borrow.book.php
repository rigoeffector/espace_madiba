<?php
//   Headers 
header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/book/book.php';
$database = new Database();
$db = $database->connect();
// instatiate our UserRegister
$borrowed_books = new BookInformation($db);
$borrowed_books->id = isset($_GET['id']) ? $_GET['id'] : die();
if(!NULL == $borrowed_books->id){
    $result = $borrowed_books->readSingleBookBorrowed();
}
    
    

