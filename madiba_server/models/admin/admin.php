<?php session_start();
class Login {
    private $pass;
    private $username;
    private $conn;
    private $table = 'admin';
    public $admin;


    public function __construct($db)
    {
        $this->conn=$db;
    }
    public function setUsername($username){
        $this->username = $username;
    }
    public function getUsername(){
        return $this->username;
    }


    public function setPass($password){
        $this->pass = $password;
    }

    public function getPass(){
        return $this->pass;
    }


    public function getUser(){
        #query
        $query = "SELECT * FROM $this->table WHERE username=:username AND password =:passwords";
        $stmt = $this->conn->prepare($query);
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pass = htmlspecialchars(strip_tags($this->pass));
        $stmt->bindParam(":username",$this->username);
        $stmt->bindParam(":passwords",$this->pass);

        if($stmt->execute()){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row['username']){
                $_SESSION['admin'] = $row['username'];
                $_SESSION['adminId'] = $row['id'];
                header('Location: settings.php');
            }
            else{
                header('Location: index.php');  
                $_SESSION['message']= 'Invalid username or passwod';
            }
          
           return;
        }
        else{
          
        }
    }

    public function read()
    {
        $query = "SELECT * FROM `admin`";

        //    prepare statements 

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

}