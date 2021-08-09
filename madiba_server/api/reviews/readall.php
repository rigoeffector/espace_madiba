<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/reviews/index.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserCategory 

$reviews = new Reviews($db);

$result = $reviews->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $reviews_arr = array();
    $reviews_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $reviews_item = array(

            "id" => $id,
            "bookId" => $bookId,
            "userId" => $userId,
            "description" => $description,
            "helpful" => $helpful,
            "title" => $title,
            "numbers" => $numbers,
            "authors" => $authors,
            "image" => $image,
            "summary" => $summary,
            "fname" => $fname,
            "lname" => $lname,
            "address" => $address,
            "phone" => $phone,
        );

        // Push to array  

        array_push($reviews_arr['data'], $reviews_item);
        $response = array(
            "status" => "success",
            "error" => false, "success" => true,
            "message" => " book review is  fetched successfully",
            "data"=>$reviews_arr['data']
        );
        echo json_encode(
            $response
        );

        // turn it to json mode 


    }
   
} else {
    $response = array(
        "status" => "success",
        "error" => false, "success" => true,
        "message" => " No reviews yet",
        "data"=>[]
    );
    echo json_encode(
        $response
    );
}
