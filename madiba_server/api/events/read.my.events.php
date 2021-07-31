

<?php
//   Headers 
header('Access-Controll-Allow-Origin: *');
header('Content-Type:application/json');
include_once '../../config/Database.php';
include_once '../../models/events/events.php';
$database = new Database();
$db = $database->connect();
// instatiate our UserCategory 

$events = new Events($db);

$events->userId = isset($_GET['id']) ? $_GET['id'] : die();
if (!NULL ==$events->userId) {

    $result = $events->readMyEvents(
        $events->userId
    );
    // get Row Count 
    $num = $result->rowCount();

    if ($num > 0) {
        $events = array();
        $events['data'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $events_item = array(

                "id" => $id,
                "userId" => $userId,
                "eventId" => $eventId,
                "place_booked" => $place_booked,
                "createdTime" => $createdTime,
                "fname" => $fname,
                "lname" => $lname,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "image" => $image,
                "eventTitle" => $eventTitle,
                "eventDescription " => $eventDescription,
                "eventImage " => $eventImage,
                "eventLocation " => $eventLocation,
                "eventTime " => $eventTime,
                "eventDate " => $eventDate,
                "eventPrice " => $eventPrice,
                "available_places " => $available_places,


            );
            array_push($events['data'], $events_item);
            

        }
        // Push to array  
        $response = array(
            "status" => "success",
            "error" => false,
            "message" => "My events is fetched successfully",
            "data" => $events['data'],

        );
        echo  json_encode(
            $response
        );
      
    } else {
        $response = array(
            "status" => "success",
            "data" => [],
            "error" => false,
            "message" => "No Events  Category Found"
        );
        echo  json_encode(
            $response
        );
    }
}


       

        


