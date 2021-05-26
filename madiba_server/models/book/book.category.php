<?php

use JetBrains\PhpStorm\Deprecated;

class BookCategory
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'book_category';

    // UserCategory properties


    public $id ;
    public $title;
    public $number_of_books;
    public $languages;
    public $icon_image;
    public $created_time;
   
    

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
        uc.title as userClass, uc.age_range,
        b.created_time 
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


    public function readSingleBook()
    {
        $query = "SELECT b.id, b.title,
        b.numbers, b.authors, b.image,
        b.summary,bc.title as book_category,
        bc.number_of_books, 
        bc.languages,
        b.isAvailable as thisBookIsAvailable,
        uc.title as user_class,
        uc.age_range 
        from 
            $this->table b
        LEFT JOIN user_classes uc
        ON
        b.user_classesId = uc.id
        LEFT JOIN 
        book_category bc
        ON
        b.book_categoryId = bc.id 
         WHERE b.id = ?";
      

        //  bind id 


        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //  SET PROPERTIES 


        $this->id = $row['id'];
        $this->numbers = $row['numbers'];
        $this->title = $row['title'];
        $this->authors = $row['authors'];
        $this->image = $row['image'];
        $this->summary = $row['summary'];
        $this->languages = $row['languages'];
        $this->book_category = $row['bbook_category'];
        $this->number_of_books = $row['number_of_books'];
        $this->thisBookIsAvailable = $row['thisBookIsAvailable'];
        $this->user_class = $row['user_class'];
        $this->age_range = $row['age_range'];

      

        
    }

    public function create()
    {
        // Deprecated to other files 
    }


    public function update()
    {
        // Deprecated TO OTHER FILES 
    }

    public function viewBooksByCategory(){
        $query ="";
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
