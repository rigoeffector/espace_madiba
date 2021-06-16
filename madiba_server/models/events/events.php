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
            error_log("Success", $this->title, 0);
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
            error_log("Delete class Error", 0);
        }
    }
}
