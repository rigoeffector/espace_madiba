<?php

class LoginUserInfo
{
    private $password;
    private $email;
    private $conn;
    public $admin;
    public $fname;


    public function __construct($db)
    {
        $this->conn = $db;
    }



    public function getUserLogin($email, $password)
    {
        $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "duhure");
        // $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "duhure");
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        };

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // $checkName = "select * from user_classes where title = '$title' and age_range='$age' and usercategoryId='$usercategoryId'";
        $sql = ("select * from registartion_users where email = '$email'
          and password='$password'");
        $result = mysqli_query($conn, $sql);
        
        $token = bin2hex(random_bytes(30));
        $userId = "";
        if (mysqli_num_rows($result) > 0) {
            

            while ($row = mysqli_fetch_assoc($result)) {
                $feesPaid = $row['isMembershipPaid'];
                $created_time = $row['created_time'];
                $userId = $row['id'];
            }
            $membershipValid =  date('Y-m-d', strtotime($created_time . ' +  1month'));

            if (date('Y-m-d') > $membershipValid) {
                $query = "UPDATE registartion_users SET isMembershipPaid = '0' WHERE  id ='$userId'";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();


                $response = array(
                    "status" => "error",
                    "error" => true, "success" => false,
                    "message" => "You membership is ended at," . $membershipValid . "  please update it quickly"
                );
                echo json_encode(
                    $response
                );
                return $stmt;
            } else {
                // $d = date('Y-m-d');
               
                // $query = "UPDATE registartion_users SET token = '$token' and token_time='$d' WHERE  id ='$userId'";
                // $stmt = $this->conn->prepare($query);
                // $stmt->execute();
                // var_dump($query);
                #query
                $query = "SELECT r.id, r.fname,r.lname,r.address,r.phone, 
                   r.email,r.password,r.image,r.isMembershipPaid,r.token,
                   uc.title as userclass,
                   uc.age_range, uct.title as usercategory, uct.id as userCatId,
                   uct.membership_fees
                   from registartion_users r 
                   LEFT JOIN user_classes uc 
                   ON r.user_classesId = uc.id
                   LEFT JOIN book ON r.user_classesId = book.user_classesId
                   LEFT JOIN user_category uct
                   ON r.user_categoryId = uct.id 
                   where r.email ='$email' 
                   and r.password ='$password' ";
                // $stmt = $this->conn->prepare($query);
                $stmt = $this->conn->query($query);
                

                $stmt->execute();
                return $stmt;
            }
        }
        else{
            $response = array(
                "status" => "error",
                "data"=>[],
                "error" => false,
                "message" => "No user info  Found or you did not paid your membership fees"
            );
            echo  json_encode(
                $response
            );
        }
    }
}
