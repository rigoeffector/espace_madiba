<?php
//   Headers 


header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');


include_once '../../config/Database.php';
include_once '../../models/news/news.php';


$database = new Database();
$db = $database->connect();


// instatiate our UserCategory 

$news_feed = new NewsFeed($db);

$result = $news_feed->read();

// get Row Count 


$num = $result->rowCount();

if ($num > 0) {
    $news_feed_arr = array();
    $news_feed_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $news_feed_item = array(

            "id" => $id,
            "title" => $title,
            "summary" => $summary,
            "created_time" => $created_time,
            "image" => $image
        );

        // Push to array  

        array_push($news_feed_arr['data'], $news_feed_item);

        // turn it to json mode 


    }
    echo json_encode($news_feed_arr);
} else {
    echo  json_encode(
        array("message" => "No News Feed Found ")
    );
}
