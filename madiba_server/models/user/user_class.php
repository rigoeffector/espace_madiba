<?php
class UserClasses
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'user_classes';

    // UserClass properties


    public $id;
    public $title;
    public $user_categoryId;
    public $created_time;
    public $age_range;

    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT c.id, c.title as classe_title , 
          c.user_categoryId,
          u.id  as user_category_id ,
          u.title as user_category_title,
          u.membership_fees, 
          c.created_time,
          c.age_range   
          FROM  
            $this->table c
          LEFT JOIN
            user_category u
            ON
          c.user_categoryId = u.id";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readSingleCategory()
    {
        $query = 'SELECT id, title, 
        membership_fees
         FROM ' . $this->table . ' 
         WHERE id = ? LIMIT O,1';
        $stmt = $this->conn->prepare($query);

        //  bind id 


        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //  SET PROPERTIES 


        $this->title = $row['title'];
        $this->membership_fees = $row['membership_fees'];
    }

    public function create($title,$age,$usercategoryId)
    {
       
        $query = "INSERT INTO $this->table 
        ( title, user_categoryId, created_time,age_range)
        VALUES (:title,:user_categoryId,:created_time,:age_range)";
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->user_categoryId = htmlspecialchars(strip_tags($this->user_categoryId));
        $this->created_time = htmlspecialchars(strip_tags($this->created_time));
        $this->age_range = htmlspecialchars(strip_tags($this->age_range));



        // bind data 
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":user_categoryId", $this->user_categoryId);
        $stmt->bindParam(":created_time", $this->created_time);
        $stmt->bindParam(":age_range", $this->age_range);

        // $checkName = "select * from user_classes where title = '$title' and age_range='$age' and usercategoryId='$usercategoryId'";
        $stmt = $this->conn->query("select * from user_classes where title = '$title' and age_range='$age' and usercategoryId='$usercategoryId'");
        $row_count = $stmt->rowCount();
        if ($row_count > 0) {
            $response = array(
                "status" => "success",
                "error" => false, "success" => true,
                "message" => "you are already saved this user class with this title and this age"
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
        user_categoryId =:user_categoryId,
        age_range =:age_range
           
         WHERE 
            id=:id';
        $stmt = $this->conn->prepare($query);
        // clean data to be bound  


        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->user_categoryId = htmlspecialchars(strip_tags($this->user_categoryId));
        $this->age_range = htmlspecialchars(strip_tags($this->age_range));



        // bind data 
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":user_categoryId", $this->user_categoryId);
        $stmt->bindParam(":age_range", $this->age_range);


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
                array('message' => 'Delete user class  Failed ')
            );
        }
    }
}
