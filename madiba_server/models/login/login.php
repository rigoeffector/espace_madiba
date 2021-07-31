<?php

class LoginUserInfo {
    private $password;
    private $email;
    private $conn;
    public $admin;


    public function __construct($db)
    {
        $this->conn=$db;
    }
   


    public function getUserLogin($email, $password){
        #query
        $query = "SELECT r.id, r.fname,r.lname,r.address,r.phone, 
        r.email,r.password,r.image,r.isMembershipPaid,
        uc.title as userclass,
        uc.age_range, uct.title as usercategory,
        uct.membership_fees,
        book.id as bid, book.title as booktitle,
        book.numbers, book.authors,
        book.image,book.summary,
        book.languages,book.isAvailable
        from registartion_users r 
        LEFT JOIN user_classes uc 
        ON r.user_classesId = uc.id
        LEFT JOIN book ON r.user_classesId = book.user_classesId
        LEFT JOIN user_category uct
        ON r.user_categoryId = uct.id 
        where r.email ='$email' 
        and r.password ='$password' ";

        $stmt = $this->conn->prepare($query);
        
        // $stmt->bindParam(":email",$email);
        // $stmt->bindParam(":passwords", $password);

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
      

        return $stmt;
    }

   

}
