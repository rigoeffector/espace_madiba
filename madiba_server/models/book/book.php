<?php

use JetBrains\PhpStorm\Deprecated;

class BookInformation
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'book';
    private $tables = 'video_book';
    private $tablesAudio = 'audio_book';

    // UserCategory properties


    public $id;
    public $title;
    public $numbers;
    public $authors;
    public $image;
    public $summary;
    public $languages;
    public  $book_category;
    public $number_of_books;
    public $thisBookIsAvailable;
    public $user_class;
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
        b.book_categoryId = bc.id";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readByCategory($id)
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
        where b.book_categoryId = $id";


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
        $stmt->bindParam(1, $this->id);
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



    public function getBookByCategory()
    {
    }

    public function borrowBook()
    {
    }

    public function readVideoBook()
    {
        $query = "SELECT video_book.id, video_book.title, video_book.summary, 
        video_book.video_url, video_book.auhtor,
        video_book.user_classesId, video_book.user_categoryId,
         video_book.auhtor,
        user_classes.title as userClassTitle, 
        user_classes.age_range,
        user_category.title as userCategoryTitle,
         user_category.membership_fees,
        book_category.title as bookCategory, 
        book_category.number_of_books, book_category.languages
        FROM video_book
    
        LEFT JOIN user_classes
        ON video_book.user_classesId = user_classes.id
        LEFT JOIN user_category
        on video_book.user_categoryId = user_category.id
        LEFT JOIN book_category
        on video_book.bookCategoryId = book_category.id
       ";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readAudioBook()
    {
        $query = "SELECT au.id, au.title, au.summary, 
        au.audio_url, 
        au.user_classesId, au.user_categoryId,
        au.author,
        u.title as userClassTitle, 
        u.age_range,
        uc.title as userCategoryTitle,
         uc.membership_fees,
        bc.title as bookCategory, 
        bc.number_of_books, bc.languages
        FROM audio_book au
    
        LEFT JOIN user_classes u
        ON au.user_classesId = u.id
        LEFT JOIN user_category uc
        on au.user_categoryId = uc.id
        LEFT JOIN book_category bc
        on au.bookCategoryId = bc.id
       ";
        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
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


    public function deleteVideo()
    {
        $query = 'DELETE FROM ' . $this->tables . ' WHERE id = :id ';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'Delete video  Failed ')
            );
            error_log("Delete category Error", 0);
        }
    }

    public function deleteAudio()
    {
        $query = 'DELETE FROM ' . $this->tablesAudio . ' WHERE id = :id ';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'Delete audio  Failed ')
            );
            error_log("Delete category Error", 0);
        }
    }
}
