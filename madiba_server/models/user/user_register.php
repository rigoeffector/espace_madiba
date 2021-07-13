<?php
class UserRegister
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'registartion_users';

    // UserCategory properties


    public $id;
    public $fname;
    public $lname;
    public $address;
    public $phone;
    public $user_categoryId;
    public $email;
    public $password;
    public $isMembershipPaid;
    public $user_classesId;

    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT r.id, r.fname, r.lname, 
        r.address, r.phone, u.title,
        u.membership_fees, r.email, 
        r.image,
        r.password, c.age_range,
        r.isMembershipPaid,
         c.id as user_classesIds,
          c.title as 
          class_title 
          FROM registartion_users r
           LEFT JOIN 
           user_category u ON r.user_categoryId = u.id LEFT JOIN user_classes c ON r.user_classesId = c.id ORDER BY id DESC
        ";


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
        $created_time = $row['created_time'];
    }

    public function create()
    {
        //DEPRECATED IN OTHER FILES
    }

    public function update()
    {
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
