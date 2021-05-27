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

$book_cat->age_range = isset($_GET['age']) ? $_GET['age'] : die();

if (!NULL == $book_cat->age_range) {
    $result = $book_cat->viewBooksByCategoryByUserClass($book_cat->age_range);

    // get Row Count 


    $num = $result->rowCount();

    if ($num > 0) {
        $book_cat_arr = array();
        $book_cat_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $book_cat_item = array(

                "id" => $id,
                "bookCatTitle" => $bookCatTitle,
                "number_of_books" => $number_of_books,
                "languages" => $languages,
                "userClassTitle" => $userClassTitle,
                "user_categoryId" => $user_categoryId,
                "icon_image" => $icon_image,
                "age_range" => $age_range



            );

            // Push to array  

            array_push($book_cat_arr['data'], $book_cat_item);

            // turn it to json mode 


        }
        echo json_encode($book_cat_arr);
    } else {
        echo  json_encode(
            array("message" => "No Book Data  Found ")
        );
    }
}
