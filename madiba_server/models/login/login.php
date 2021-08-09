<?php

class LoginUserInfo {
    private $password;
    private $email;
    private $conn;
    public $admin;
    public $fname;


    public function __construct($db)
    {
        $this->conn=$db;
    }
   


    public function getUserLogin($email, $password){
        #query
        $query = "SELECT r.id, r.fname,r.lname,r.address,r.phone, 
        r.email,r.password,r.image,r.isMembershipPaid,
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
        and r.password ='$password' and r.isMembershipPaid='1' ";

        $stmt = $this->conn->prepare($query);
        
        // $stmt->bindParam(":email",$email);
        // $stmt->bindParam(":passwords", $password);

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      

        return $stmt;
    }

   

}
