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
        membership_fees,created_time
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
        $created_time = $row['created_time'];
    }

    public function create()
    {
        $query = "INSERT INTO $this->table 
        ( title, membership_fees, created_time)
        VALUES (:title,:membership_fees,:created_time)";
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->membership_fees = htmlspecialchars(strip_tags($this->membership_fees));
        $this->created_time = htmlspecialchars(strip_tags($this->created_time));




        // bind data 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":membership_fees", $this->membership_fees);
        $stmt->bindParam(":created_time", $this->created_time);


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
        title =:title,
        membership_fees =:membership_fees
           
         WHERE 
            id=:id';
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->membership_fees = htmlspecialchars(strip_tags($this->membership_fees));



        // bind data 
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":membership_fees", $this->membership_fees);


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
            error_log("Delete category Error", 0);
        }
    }
}
