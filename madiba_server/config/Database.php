<?php 

class Database {
    // DB PARAMS
    private $host = 'localhost';
    // private $db_name = 'madiba';
    // private $password = '';
    // private $username ='root';

    private $db_name = 'madiba';
    private $password = 'digitaloceaN@00d';
    private $username ='Toussaint';

    private $conn;

     // // $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "madiba");


    public function  connect(){
        $this->conn = null;

        try{
              $this->conn = new PDO('mysql:host=' .$this->host . ';dbname='. $this->db_name,$this->username, $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          
        }catch(PDOException $e){
                echo 'Connection Erro'. $e->getMessage();
        }

        return $this->conn;
    }
}

?>