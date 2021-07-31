<?php
class Events
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'events';

    // UserClass properties


    public $id;
    public $title;
    public $description;
    public $categoryId;
    public $image;
    public $location;
    public $time;
    public $category;
    public $date;
    public $is_free;
    public $price;
    public $available_places;
    public $status;
    public $userId;
    public $eventId;
    public $place_booked;
    public $remainPlaces;


    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT e.id, e.title, e.description, 
                         e.categoryId, e.image, e.location, e.time, 
                         ec.title as category ,e.date, e.is_free,
                         e.price, e.available_places
                  FROM 
                   events e
                  LEFT JOIN events_category ec  
                       ON e.categoryId  = ec.id";

        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readSingleCategory()
    {
        $query = 'SELECT e.id, e.title, e.description, 
        e.categoryId, e.image, e.location, e.time, 
        ec.title as category ,e.date, e.is_free,
        e.price, e.available_places, e.status
 FROM 
  events e
 LEFT JOIN events_category ec  
      ON e.categoryId  = ec.id

         WHERE e.id = ?';
        $stmt = $this->conn->prepare($query);

        //  bind id 
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //  SET PROPERTIES 
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->description = $row['description'];
        $this->categoryId = $row['categoryId'];
        $this->category = $row['category'];
        $this->location = $row['location'];
        $this->image = $row['image'];
        $this->time = $row['time'];
        $this->date = $row['date'];
        $this->is_free = $row['is_free'];
        $this->price = $row['price'];
        $this->available_places = $row['available_places'];
        $this->status = $row['status'];
    }

    public function create()
    {
        $query = "INSERT INTO $this->table 
        (  `title`, `description`, `categoryId`, `image`, `location`, `time`, `is_free`, `price`)
        VALUES (:title,:description,:categoryId,:image,:location,:time,:is_free,price)";
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->title = htmlspecialchars(strip_tags($this->title));

        // bind data 
        $stmt->bindParam(":title", $this->title);
        // execute the query 
        if ($stmt->execute()) {

            return true;
        }
        // print error if something goes bad 
        print_r("Error:%s.\n", $stmt->error);
        return false;
    }


    public function update()
    {
        $query = 'UPDATE ' . $this->table . ' 
         SET  
        title =:title
         WHERE 
            id=:id';
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        // bind data 
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        // execute the query 
        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes bad 
        print_r("Error:%s.\n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id ';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'Delete event   Failed ')
            );
        }
    }

    public function bookPlace($id, $requestedDays)
    {
        include "../../config/Config.php";

        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT available_places FROM `events` WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {

                $this->remainPlaces = $row["available_places"];
            }
        } else {
            echo "0 results";
        }
        if ($this->remainPlaces > 0 &&  !((int)$this->remainPlaces < (int)$requestedDays)) {
            $query = 'INSERT INTO event_history (userId, eventId, place_booked)
            values(:userId,:eventId,:place_booked)';
            $stmt = $this->conn->prepare($query);
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->eventId = htmlspecialchars(strip_tags($this->eventId));
            $this->place_booked = htmlspecialchars(strip_tags($this->place_booked));
            $stmt->bindParam(":userId", $this->userId);
            $stmt->bindParam(":eventId", $this->eventId);
            $stmt->bindParam(":place_booked", $this->place_booked);
            if ($stmt->execute()) {
                return $stmt;
            } else {
                echo json_encode(
                    array('message' => 'book place   Failed ')
                );
            }
        } else {
            $response = array(
                "status" => "success",
                "error" => false,
                "success" => true,
                "message" => "There no other places available for this event"
            );
            echo json_encode(
                $response
            );
        }
    }
    public function updatePlace($requested, $id)

    {
        include "../../config/Config.php";
        $sql = "SELECT available_places FROM `events` WHERE id = '12'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $this->remainPlaces = $row["available_places"];
            }
        } else {
            echo "0 results";
        }
        $remainPlaces = $this->remainPlaces - $requested;

        $db_query = "UPDATE events 
            SET 
               available_places=:available_places
                     WHERE id=$id";
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->eveavailable_placestId = htmlspecialchars(strip_tags($this->available_places));
        $stmt = $this->conn->prepare($db_query);
        $stmt->bindParam(":available_places", $remainPlaces);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'book place update is    Failed ')
            );
        }
    }

    public function readMyEvents($id)
    {
        $query = "SELECT eh.id, eh.userId, eh.eventId, eh.place_booked, eh.createdTime,
        u.fname, u.lname, u.address, u.phone,u.email,u.image, e.title as eventTitle,
        e.description as eventDescription, e.image as eventImage, e.location as eventLocation,
        e.time as eventTime, e.date as eventDate,e.is_free,e.price as eventPrice,e.available_places,
        e.status as eventStatus
        FROM event_history eh
        LEFT JOIN events e ON eh.eventId = e.id
        LEFT JOIN registartion_users u  ON eh.userId = u.id where u.id  = $id";
        $stmt = $this->conn->prepare($query);
        //    prepare statements 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
       
    }
}
