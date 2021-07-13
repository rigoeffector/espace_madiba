<?php

use JetBrains\PhpStorm\Deprecated;

class BookCategory
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'book_category';

    // UserCategory properties


    public $id;
    public $title;
    public $number_of_books;
    public $languages;
    public $icon_image;
    public $created_time;
    public $userClass;
    public $age_range;



    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT b.id, b.title,
        b.languages, b.number_of_books, b.icon_image,
        uc.title as userClass, uc.age_range
   
        from book_category b
        LEFT JOIN user_classes uc
        ON
        b.user_classesId = uc.id
       ";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readSingleBookCat()
    {
        $query = "SELECT b.id, b.title,
        b.languages, b.number_of_books, b.icon_image,
        uc.title as userClass, uc.age_range
         
        from book_category b
        LEFT JOIN user_classes uc
        ON
        b.user_classesId = uc.id 
         WHERE b.id = ?";


        //  bind id 


        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //  SET PROPERTIES 


        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->number_of_books = $row['number_of_books'];
        $this->languages = $row['languages'];
        $this->userClass = $row['userClass'];
        $this->age_range = $row['age_range'];
        $this->icon_image = $row['icon_image    '];
        $this->created_time = $row['created_time'];
    }

    public function checkBeforecreate()
    {
        // Deprecated to other files 
    }


    public function update()
    {
        // Deprecated TO OTHER FILES 
    }

    public function viewBooksByCategory()
    {
        $query = "";
    }

    public function viewBooksByCategoryByUserClass($age_range)
    {
        $query = "SELECT b.id,b.title as bookCatTitle,b.number_of_books,b.languages,b.icon_image,
        u.title as userClassTitle,u.user_categoryId, u.age_range
         FROM book_category b LEFT JOIN 
        user_classes u ON 
        b.user_classesId = u.id WHERE u.age_range LIKE '$age_range%'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
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
