<?php


class Reviews
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'reviews';

    // UserCategory properties


    public $id;
    public $userId;
    public $bookId;
    public $image;
    public $description;
    public $helpful;



    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties

    public function createReview()
    {
        $query = "INSERT INTO `reviews`(`userId`, `bookId`, `description`,`helpful`)
         VALUES(:userId,:bookId,:description,:helpful)";

        $stmt = $this->conn->prepare($query);
         $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->bookId = htmlspecialchars(strip_tags($this->bookId));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->helpful = htmlspecialchars(strip_tags($this->helpful));
     
        // bind data 
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":bookId", $this->bookId);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":helpful", $this->helpful);
    
        $stmt->execute();

        return $stmt;
    }
    public function read()
    {
        $query = "SELECT 
        r.id, r.userId,r.bookId,r.description,r.helpful,
        b.title,b.numbers,b.authors,b.image,b.summary,
        ru.fname,ru.lname,ru.address,ru.phone
        FROM reviews r LEFT JOIN book b on r.bookId = b.id
        LEFT JOIN registartion_users ru on r.userId = ru.id 
       ";


        //    prepare statements 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


 
}
