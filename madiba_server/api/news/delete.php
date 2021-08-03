<?php
/*
* @param Type var Description
*author Rigoeffector Ninja
*created at 15/09/2019
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header('Access-Control-Allow-Methods:DELETE');
header("Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");
include_once "../../config/Database.php";
include_once "../../models/news/news.php";
$database = new Database();
$db = $database->connect();
$post = new NewsFeed($db);
$data = json_decode(file_get_contents("php://input")); 
$post->id = $data->id;
if ($post->delete()) {
    echo json_encode(
        array(
            "message" => "post deleted ducccessfully"
        )
    );
} else {
    echo json_encode(
        array(
            "message" => "Failed to delete post"
        )
    );
}
