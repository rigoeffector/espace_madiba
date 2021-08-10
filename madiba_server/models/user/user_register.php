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
    public $userId;
    public $amount;
    public $status;
    public $suscriptionId;
    public $transaction_id;
    public $somedata;

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

    public function updatePaymnentStatus($phone)
    {
        $query = "UPDATE   $this->table 
        SET isMembershipPaid=1 
         WHERE phone = $phone";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {

            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'paymnent update  Failed ')
            );
        }
    }
    public function readHistory()
    {
        $query = "SELECT p.id,p.amount,p.suscriptionId,p.transaction_id,p.created_time,
        uc.title as userCategoryTitle,
        uc.membership_fees as suscriptionFees,
        uc.Description as subscriptionDescription,
        r.fname, r.lname,r.address,r.phone,r.isMembershipPaid,r.added_by
        FROM payment_history p  LEFT JOIN registartion_users r 
        ON p.phone = r.phone
        LEFT JOIN user_category uc
        ON P.suscriptionId = uc.id";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {

            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'paymnent history  is  Failed to fecth ')
            );
        }
    }

    public function addChild()
    {

        //  DUPLICATED

    }

    public function paymentHistory($phone, $amount, $suscriptionId,  $status, $transaction_id)
    {
        $query = "INSERT INTO payment_history(
            `amount`, `suscriptionId`, `status`, `transaction_id`, `phone`)
             VALUES(
             :amount,
             :suscriptionId,
             :status,
             :transaction_id,
             :phone
             )";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":suscriptionId", $suscriptionId);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":transaction_id", $transaction_id);
        $stmt->bindParam(":phone", $phone);

        if ($stmt->execute()) {
            //  var_dump($stmt);
            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'paymnent history  is  Failed to fecth ')
            );
        }
    }

    public function searchPeopleByPhone($phone)
    {
        include "../../config/Config.php";
        $check = "SELECT * FROM registartion_users 
        WHERE phone LIKE '%$phone%'";
        $rowcount = null;


        if ($result = mysqli_query($connect, $check)) {
            $rowcount = mysqli_num_rows($result);
            mysqli_free_result($result);
        }

        if ($rowcount > 0) {
            $query = "SELECT * FROM registartion_users 
            WHERE phone LIKE '%$phone%'";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

         
            $this->id = $row['id'];
            $this->fname = $row['fname'];
            $this->lname = $row['lname'];
            $this->address = $row['address'];
            $this->phone = $row['phone'];


            // extract as jsons 
            $response = array(
              
                "id" => $row['id'],
                "fname" => $row['fname'],
                "lname" => $row['lname'],
                "phone"=>$row['phone'],
                "address"=>$row['address'],
                "message" => "User Found"
            );
            echo  json_encode(
                $response
            );
        }
        else  {

            $response = array(
                "message" => "No id  Found"
            );
            echo  json_encode(
                $response 
            );
        } 
    }
}
