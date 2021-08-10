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
    public $numbersToSaved;
    public $bookId;
    public $description;
    public $number_of_book_borrowed;
    public $userId;
    public $isAvailable;
    public $book_borrowed;
    public $available_books;
    public $return_date;
    public $borrowed_book_status;
    public $status;
    public $taken_book;
    public $bookStatus;
    public $createdTime;
    public $bookTitle;
    public $bookAuthor;
    public $bookIcon;
    public $bookSummary;
    public $book_categoryId;
    public $user_classesId;
    public $fname;
    public $lname;
    public $address;
    public $phone;
    public $email;
    public $isMembershipPaid;
    public $bookCategorTitle;
    public $bookCategoryIcon;
    public $userClassTitle;
    public $userClassAge;
    public $checkup;
    public $keywords;

    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT b.id, b.title,
        b.numbers, b.taken_book, b.authors, b.image,
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
        $this->book_category = $row['book_category'];
        $this->number_of_books = $row['number_of_books'];
        $this->thisBookIsAvailable = $row['thisBookIsAvailable'];
        $this->user_class = $row['user_class'];
        $this->age_range = $row['age_range'];
    }

    public function create()
    {
        // Deprecated to other files 
    }



    public function getBookByCategoryandAge($id, $age)
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
            book b
        LEFT JOIN user_classes uc
        ON
        b.user_classesId = uc.id
        LEFT JOIN 
        book_category bc
        ON
        b.book_categoryId = bc.id
        where b.book_categoryId = '$id' and uc.age_range = '$age'";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function getAudioByCategoryandAge($id, $age)
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
        WHERE u.age_range = '$age' and bc.id ='$id'";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    public function borrowBook($id, $requested)
    {
        $sql = "INSERT INTO borrow_history
        (bookId, number_of_book_borrowed, userId,return_date)
        VALUES (:bookId,:number_of_book_borrowed,:userId,:return_date)";


        $stmt = $this->conn->prepare($sql);
        // clean data to be bound  

        $this->bookId = htmlspecialchars(strip_tags($this->bookId));
        $this->number_of_book_borrowed = htmlspecialchars(strip_tags($this->number_of_book_borrowed));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->return_date = htmlspecialchars($this->return_date);

        // bind data 
        $stmt->bindParam(":bookId", $this->bookId);
        $stmt->bindParam(":number_of_book_borrowed", $this->number_of_book_borrowed);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":return_date", $this->return_date);
        if ($this->checkIfBorrowedBook($this->userId)) {
            include_once $_SERVER['DOCUMENT_ROOT']."/madiba_server/config/Config.php";

            if (!$connect) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $sql = "SELECT numbers FROM `book` WHERE id = '$id'";
            $result = mysqli_query($connect, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {

                    $this->available_books = $row["numbers"];
                }
            } else {
                // echo "0 results";
            }
            if ($this->available_books > 0 &&  !((int)$this->available_books < (int)$requested)) {

                if ($stmt->execute()) {
                    $this->saveTakenNumberOfBooks($this->bookId, $this->number_of_book_borrowed);
                    return true;
                }
                print_r("Error:%s.\n", $stmt->error);
                return false;
            }
            $response = array(
                "status" => "success",
                "error" => false,
                "success" => true,
                "message" => "There is no other book available for today"
            );
            echo json_encode(
                $response
            );
        }
    }

    public function saveTakenNumberOfBooks($bookId, $takenNumberBooks)
    {
        $sql = "UPDATE  book
               SET taken_book=:taken_book
                WHERE id=$bookId";
        $stmt = $this->conn->prepare($sql);
        // clean data to be bound  
        $this->taken_book = htmlspecialchars(strip_tags($this->taken_book));
        $stmt->bindParam(":taken_book", $takenNumberBooks);
        if ($stmt->execute()) {
            return true;
        }
    }


    public function checkIfBorrowedBook($userId)
    {
        include_once $_SERVER['DOCUMENT_ROOT']."/madiba_server/config/Config.php";

        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT status FROM `borrow_history` WHERE userId = '$userId' and status = '0'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $this->borrowed_book_status = $row["status"];
            }
            $response = array(
                "status" => "success",
                "error" => false,
                "success" => true,
                "message" => "You are already borrow a book"
            );
            echo json_encode(
                $response
            );
            return false;
        } else {
            return true;
        }
    }

    public function updateNumberOfBooks($requested, $id)

    {
        include_once $_SERVER['DOCUMENT_ROOT']."/madiba_server/config/Config.php";
        $sql = "SELECT numbers FROM `book` WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $this->available_books = $row["numbers"];
            }
        } else {
            // echo "0 results";
        }
        $remainBooks = $this->available_books - $requested;

        $db_query = "UPDATE book 
            SET 
               numbers=:numbers
                     WHERE id=$id";
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->numbersToSaved = htmlspecialchars(strip_tags($this->numbersToSaved));

        $stmt = $this->conn->prepare($db_query);
        $stmt->bindParam(":numbers", $remainBooks);

        if ($stmt->execute()) {
            if (!$remainBooks > 0) {
                $this->updateStatusBook($id);
            } else {
                return $stmt;
            }
        } else {
            echo json_encode(
                array('message' => ' update book numbers  is    Failed ')
            );
        }
    }

    public function updateStatusBook($id)
    {

        include_once $_SERVER['DOCUMENT_ROOT']."/madiba_server/config/Config.php";
        $sql = "SELECT numbers FROM `book` WHERE id = '$id'";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $this->available_books = $row["numbers"];
            }
        } else {
            // echo "0 results";
        }

        if ($this->available_books > 0) {
            $db_query = "UPDATE book 
            SET 
            isAvailable='1'
                     WHERE id=$id";
        } else {
            $db_query = "UPDATE book 
            SET 
            isAvailable='0'
                     WHERE id=$id";
        }

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt = $this->conn->prepare($db_query);
        if ($stmt->execute()) {
            return $stmt;
        } else {
            echo json_encode(
                array('message' => ' update book isAvailable  is    Failed ')
            );
        }
    }

    public function readVideoBook()
    {
        $query = "SELECT video_book.id, 
        video_book.title, video_book.summary, 
        video_book.video_url,
        video_book.user_classesId, 
        user_classes.title as userClassTitle, 
        user_classes.age_range
        FROM video_book
        LEFT JOIN user_classes
        ON video_book.user_classesId = user_classes.id

       ";


        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readMyBookBorrowed($userId)
    {
        $query = "SELECT bh.id, bh.bookId,bh.number_of_book_borrowed,
         bh.status as bookStatus,bh.userId,bh.createdTime,
          bh.return_date, b.id as bookId, b.title as bookTitle, 
          b.numbers as numbers_of_books, b.authors as bookAuthor,
           b.image as bookIcon, b.summary as bookSummary, 
           b.languages as bookLanguages, b.book_categoryId,
           b.user_classesId, b.isAvailable, u.fname, 
           u.lname,u.address,u.phone,u.email,u.image,
           u.isMembershipPaid,
        bc.title as bookCategorTitle, bc.icon_image as bookCategoryIcon,
        uc.title as userClassTitle, uc.age_range as userClassAge
        FROM borrow_history bh LEFT JOIN book b ON bh.bookId = b.id 
        LEFT JOIN book_category bc ON b.book_categoryId = bc.id
        LEFT JOIN user_classes uc ON b.user_classesId = uc.id
        LEFT JOIN registartion_users u ON bh.userId = u.id WHERE bh.userId  = '$userId'
       ";
        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readAllBookBorrowed()
    {
        $query = "SELECT bh.id, bh.bookId,bh.number_of_book_borrowed,
         bh.status as bookStatus,bh.userId,bh.createdTime,
          bh.return_date, b.id as bookId, b.title as bookTitle, 
          b.numbers as numbers_of_books, b.authors as bookAuthor,
           b.image as bookIcon, b.summary as bookSummary, 
           b.languages as bookLanguages, b.book_categoryId,
           b.user_classesId, b.isAvailable, u.fname, 
           u.lname,u.address,u.phone,u.email,u.image,
           u.isMembershipPaid,
        bc.title as bookCategorTitle, bc.icon_image as bookCategoryIcon,
        uc.title as userClassTitle, uc.age_range as userClassAge
        FROM borrow_history bh 
        LEFT JOIN book b ON bh.bookId = b.id 
        LEFT JOIN book_category bc ON b.book_categoryId = bc.id
        LEFT JOIN user_classes uc ON b.user_classesId = uc.id
        LEFT JOIN registartion_users u ON bh.userId = u.id
       ";
        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }


    public function readSingleBookBorrowed()
    {
        $query = "SELECT bh.id, bh.bookId,bh.number_of_book_borrowed,
         bh.status as bookStatus,bh.userId,bh.createdTime,
          bh.return_date, b.id as bookId, b.title as bookTitle, 
          b.numbers as numbers_of_books, b.authors as bookAuthor,
           b.image as bookIcon, b.summary as bookSummary, 
           b.languages as bookLanguages, b.book_categoryId,
           b.user_classesId, b.isAvailable, u.fname, 
           u.lname,u.address,u.phone,u.email,u.image,
           u.isMembershipPaid,
        bc.title as bookCategorTitle, bc.icon_image as bookCategoryIcon,
        uc.title as userClassTitle, uc.age_range as userClassAge
        FROM borrow_history bh 
        LEFT JOIN book b ON bh.bookId = b.id 
        LEFT JOIN book_category bc ON b.book_categoryId = bc.id
        LEFT JOIN user_classes uc ON b.user_classesId = uc.id
        LEFT JOIN registartion_users u ON bh.userId = u.id WHERE bh.id  =?
       ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);



        //  SET PROPERTIES 
        $this->id = $row['id'];
        $this->bookId = $row['bookId'];
        $this->number_of_book_borrowed = $row['number_of_book_borrowed'];
        $this->bookStatus = $row['bookStatus'];
        $this->userId = $row['userId'];
        $this->createdTime = $row['createdTime'];
        $this->return_date = $row['return_date'];
        $this->bookTitle = $row['bookTitle'];
        $this->bookAuthor = $row['bookAuthor'];
        $this->bookIcon = $row['bookIcon'];
        $this->bookSummary = $row['bookSummary'];
        $this->book_categoryId = $row['book_categoryId'];
        $this->user_classesId = $row['user_classesId'];
        $this->isAvailable = $row['isAvailable'];
        $this->fname = $row['fname'];
        $this->lname = $row['lname'];
        $this->phone = $row['phone'];
        $this->email = $row['email'];
        $this->image = $row['image'];
        $this->isMembershipPaid = $row['isMembershipPaid'];
        $this->bookCategorTitle = $row['bookCategorTitle'];
        $this->bookCategoryIcon = $row['bookCategoryIcon'];
        $this->userClassTitle = $row['userClassTitle'];
        $this->userClassAge = $row['userClassAge'];




        $borrowed_books_item = array(
            "id" => $row["id"],
            "bookId" => $row["bookId"],
            "number_of_book_borrowed" => $row["number_of_book_borrowed"],
            "bookStatus" => $row["bookStatus"] == '0' ? 'Not Returned' : 'Returned',
            "userId" => $row["userId"],
            "createdTime" => $row["createdTime"],
            "return_date" => $row["return_date"],
            "bookTitle" => $row["bookTitle"],
            "bookAuthor" => $row["bookAuthor"],
            "bookIcon" => $row["bookIcon"],
            "bookSummary" => $row["bookSummary"],
            "book_categoryId" => $row["book_categoryId"],
            "user_classesId" => $row["user_classesId"],
            "isAvailable" => $row["isAvailable"],
            "fname" => $row["fname"],
            "lname" => $row["lname"],
            "address" => $row["address"],
            "phone" => $row["phone"],
            "email" => $row["email"],
            "image" => $row["image"],
            "isMembershipPaid" => $row["isMembershipPaid"],
            "bookCategorTitle" => $row["bookCategorTitle"],
            "bookCategoryIcon" => $row["bookCategoryIcon"],
            "userClassTitle" => $row["userClassTitle"],
            "userClassAge" => $row["userClassAge"],

        );


        $response = array(
            "status" => "success",
            "error" => false, "success" => true,
            "message" => "Books fetched successfully",
            "data" => $borrowed_books_item,

        );
        echo json_encode(
            $response
        );
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
        }
    }

    public function updateBorrowInfo($bookId, $userId)
    {
        include_once $_SERVER['DOCUMENT_ROOT']."/madiba_server/config/Config.php";
        $checkUser = "SELECT *
        FROM
         borrow_history
          WHERE 
        bookId = '$bookId'
           AND
        userId='$userId'
           AND
        status='0'";
        $result = mysqli_query($connect, $checkUser);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $this->number_of_book_borrowed = $row["number_of_book_borrowed"];
            }

            $query = 'UPDATE borrow_history 
            SET return_date=:return_date
            ,status=:status WHERE userId=:userId AND bookId=:bookId';

            $stmt = $this->conn->prepare($query);
            $this->userId = htmlspecialchars(strip_tags($this->userId));
            $this->return_date = htmlspecialchars(strip_tags($this->return_date));
            $this->status = htmlspecialchars(strip_tags($this->status));
            $this->bookId = htmlspecialchars(strip_tags($this->bookId));
            $stmt->bindParam(":userId", $this->userId);
            $stmt->bindParam(":return_date", $this->return_date);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":bookId", $this->bookId);
            if ($stmt->execute()) {
                $this->updateNumberOfBookReturned(
                    $this->bookId,
                    $this->number_of_book_borrowed,
                    "1"
                );
                return $stmt;
            } else {
                echo json_encode(
                    array('message' => 'Update Borrow info Failed ')
                );
            }
        } else {
            echo json_encode(
                array('message' => 'No User found , probably this user did not borrow book  ')
            );
        }
    }

    public function updateNumberOfBookReturned($bookId, $returnedNumber, $isAvailable)
    {
        $NewnumberToSave = null;
        include_once $_SERVER['DOCUMENT_ROOT']."/madiba_server/config/Config.php";
        $checkUser = "SELECT *
        FROM
         book
          WHERE 
        id = '$bookId'
         ";
        $result = mysqli_query($connect, $checkUser);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $this->numbers = $row["numbers"];
                $this->taken_book = $row['taken_book'];
            }
            $NewnumberToSave = ((int)$this->numbers + (int)$returnedNumber);
            $TakenBookUpdate = ((int)$returnedNumber - (int)$this->taken_book);

            $query = 'UPDATE book 
                SET numbers=:numbers,
                taken_book=:taken_book,
                isAvailable=:isAvailable
                WHERE  id=:bookId';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":bookId", $bookId);
            $stmt->bindParam(":numbers", $NewnumberToSave);
            $stmt->bindParam(":taken_book", $TakenBookUpdate);
            $stmt->bindParam(":isAvailable", $isAvailable);
            if ($stmt->execute()) {
                // var_dump($stmt);
                return $stmt;
            } else {
                echo json_encode(
                    array('message' => 'Update book info Failed ')
                );
            }
        } else {
            echo json_encode(
                array('message' => 'Fetching book id failed  ')
            );
        }
    }


    public function reviews()
    {
        $query = "INSERT INTO reviews(userId,bookId,description) 
        values(:userId,:bookId,:description) ";
        $stmt = $this->conn->prepare($query);
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->bookId = htmlspecialchars(strip_tags($this->bookId));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $stmt->bindParam(":userId", $this->userId);
        $stmt->bindParam(":bookId", $this->bookId);
        $stmt->bindParam(":description", $this->description);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            echo json_encode(
                array('message' => 'Save review is  Failed ')
            );
        }
    }


    public function recommendedBooks($age)
    {
        $query = "SELECT  COUNT(bookId) as totalReviews,
        b.id as bookId,b.title,b.numbers,
        b.taken_book,b.authors,
        b.image,
        b.summary,b.languages,
        b.book_categoryId,
        b.user_classesId,
        b.isAvailable,
        bc.title as bookCategory,
        uc.title as userClass,
        uc.age_range
        FROM reviews r LEFT JOIN book b ON
        r.bookId = b.id
        LEFT JOIN user_classes uc
        
        ON b.user_classesId = uc.id
        LEFT JOIN book_category bc
        ON
        b.book_categoryId = bc.id
        where r.helpful = '1' and uc.age_range LIKE '%$age%'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {

            return $stmt;
        } else {
            echo json_encode(
                array('message' => ' review is  Failed ')
            );
        }
    }

    public function searchBook($keyword, $age)
    {
        $SQL = "SELECT b.id, b.title,
         b.numbers, b.taken_book ,
         b.authors, b.image,b.summary,
         b.languages,b.isAvailable, 
         bc.title as bookCategory,
         bc.id as bookCategoryId, 
         uc.title as userCategory,
          uc.id as userCategoryId  
          FROM book b   LEFT JOIN 
        book_category bc
        on b.book_categoryId = bc.id
        LEFT JOIN
        user_classes uc
        ON
        bc.user_classesId = uc.id
        where b.title LIKE '%$keyword%'  OR bc.title LIKE '%$keyword%'
        OR b.authors LIKE '%$keyword%' AND uc.age_range ='$age'";
        $stmt = $this->conn->prepare($SQL);
        if ($stmt->execute()) {

            return $stmt;
        } else {
            echo json_encode(
                array('message' => ' books  are   Failed to fecth ')
            );
        }
    }
}
