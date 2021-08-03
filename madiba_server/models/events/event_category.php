<?php
class EventsCategory
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'events_category';

    // UserClass properties


    public $id;
    public $title;


    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT `id`, `title` FROM `events_category`";

        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readSingleCategory()
    {
        $query = 'SELECT id, title
         FROM ' . $this->table . ' 
         WHERE id = ?';
        $stmt = $this->conn->prepare($query);

        //  bind id 
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //  SET PROPERTIES 
        $this->id = $row['id'];
        $this->title = $row['title'];
       
    }

    public function create($title)
    {
        include_once "../../config/Config.php";
        $query = "INSERT INTO $this->table 
        ( title)
        VALUES (:title)";
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->title = htmlspecialchars(strip_tags($this->title));

        // bind data 
        $stmt->bindParam(":title", $this->title);
        // execute the query 
        $checkName = "select * from events_category where title = '$title'";
        $rowcount = null;

        if ($result = mysqli_query($connect, $checkName)) {
            $rowcount = mysqli_num_rows($result);
            mysqli_free_result($result);
        }

        if ($rowcount > 0) {
            $response = array(
                "status" => "success",
                "error" => false, "success" => true,
                "message" => "you are already saved this event category"
            );
            echo json_encode(
                $response
            );
        }else{
            if ($stmt->execute()) {
           
                return true;
            }
            // print error if something goes bad 
            print_r("Error:%s.\n", $stmt->error);
            return false;
        }


        
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
        // print_r("Error:%s.\n", $stmt->error);
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
                array('message' => 'Delete event category  Failed ')
            );
           
        }
    }
}
