<?php

use JetBrains\PhpStorm\Deprecated;

class NewsFeed
{
    // DB STUFF HERE 

    private $conn;

    private $table = 'news_feed';

    // UserClass properties


    public $id;
    public $title;
    public $summary;
    public $created_time;
    public $image;

    // initialize a constructor to map with connection 

    public function __construct($db)
    {
        $this->conn = $db;
    }


    //Get properties


    public function read()
    {
        $query = "SELECT id, title, summary, created_time, image FROM $this->table ORDER BY id DESC";


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
        // Deprecated TO OTHER FILES 
    }


    public function update()
    {
    //    Deprecated TO OTHER FILES 
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
                array('message' => 'Delete user class  Failed ')
            );
            error_log("Delete class Error", 0);
        }
    }
}
