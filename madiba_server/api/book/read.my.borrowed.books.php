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

$borrowed_books->userId = isset($_GET['userId']) ? $_GET['userId'] : die();

if (!NULL == $borrowed_books->userId) {
    $result = $borrowed_books->readMyBookBorrowed($borrowed_books->userId);



    $num = $result->rowCount();

    if ($num > 0) {
        $borrowed_books_arr = array();
        $borrowed_books_arr['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $borrowed_books_item = array(

                "id" => $id,
                "bookId" => $bookId,
                "number_of_book_borrowed" => $number_of_book_borrowed,
                "bookStatus" => $bookStatus == '0' ? 'Not Returned' : 'Returned',
                "userId" => $userId,
                "createdTime" => $createdTime,
                "return_date" => $return_date,
                "bookTitle" => $bookTitle,
                "bookAuthor" => $bookAuthor,
                "bookIcon" => $bookIcon,
                "bookSummary" => $bookSummary,
                // "languages " => $languages ,
                "book_categoryId" => $book_categoryId,
                "user_classesId" => $user_classesId,
                "isAvailable" => $isAvailable,
                "fname" => $fname,
                "lname" => $lname,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "image" => $image,
                "isMembershipPaid " => $isMembershipPaid,
                "bookCategorTitle " => $bookCategorTitle,
                "bookCategoryIcon " => $bookCategoryIcon,
                "userClassTitle " => $userClassTitle,
                "userClassAge " => $userClassAge,
                "checkup " => $userClassAge,


            );

            // Push to array  

            array_push($borrowed_books_arr['data'], $borrowed_books_item);

            // turn it to json mode 


        }
        $response = array(
            "status" => "success",
            "error" => false, "success" => true,
            "message" => "Books fetched successfully",
            "data" => $borrowed_books_arr['data'],

        );
        echo json_encode(
            $response
        );
    } else {
        echo  json_encode(
            array("message" => "No Book Data  Found ")
        );
    }
}
