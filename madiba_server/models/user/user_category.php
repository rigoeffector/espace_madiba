<?php
class UserCategory
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'user_category';

    // UserCategory properties


    public $id;
    public $title;
    public $membership_fees;
    public $description;
    public $created_time;

    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = 'SELECT id, title, 
         membership_fees,
         description,
         created_time 
             FROM ' . $this->table . '
             ORDER BY created_time DESC';


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readSingleCategory()
    {
        $query = 'SELECT id, title, 
        membership_fees,description,created_time
         FROM ' . $this->table . ' 
         WHERE id = ? ';
        $stmt = $this->conn->prepare($query);

        //  bind id 


        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //  SET PROPERTIES 


        $this->title = $row['title'];
        $this->membership_fees = $row['membership_fees'];
        $this->description = $row['description'];
        // $created_time = $row['created_time'];
    }

    public function create($title)
    {
        require_once "../../config/Config.php";
        $query = "INSERT INTO $this->table 
        ( title, membership_fees, description,created_time)
        VALUES (:title,:membership_fees,:description,:created_time)";
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->membership_fees = htmlspecialchars(strip_tags($this->membership_fees));
        $this->created_time = htmlspecialchars(strip_tags($this->created_time));

        // bind data 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":membership_fees", $this->membership_fees);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created_time", $this->created_time);

        $checkName = "select * from user_category where title = '$title'";
        $rowcount = null;


        if ($result = mysqli_query($connect, $checkName)) {
            $rowcount = mysqli_num_rows($result);
            mysqli_free_result($result);
        }

        if ($rowcount > 0) {
            $response = array(
                "status" => "success",
                "error" => false, "success" => true,
                "message" => "you are already saved this category"
            );
            echo json_encode(
                $response
            );
        } else {
            // execute the query 
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
        title =:title,
<<<<<<< HEAD
        membership_fees =:membership_fees,
        description =:description
=======
        membership_fees =:membership_fees
           
>>>>>>> cf8e0a435c02108f0b5560f98956594a047cfaa9
         WHERE 
            id=:id';
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->membership_fees = htmlspecialchars(strip_tags($this->membership_fees));
        $this->description = htmlspecialchars(strip_tags($this->description));


        // bind data 
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":membership_fees", $this->membership_fees);
        $stmt->bindParam(":description", $this->description);


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
                array('message' => 'Delete user category  Failed ')
            );
        }
    }
}
