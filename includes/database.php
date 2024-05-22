<?php

// $db = new mysqli("localhost", "root","919919","native-blog");



class Database{

    private $host = "localhost";
    private $uname = "root";
    private $pass = "919919";
    private $db = "native-blog";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            // Membuat koneksi baru menggunakan PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->uname, $this->pass);
            $this->conn->exec("set names utf8");
            // Mengatur mode error PDO ke exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo "Connection Error" . $e->getMessage();
    }

    return $this->conn;
}

}
?>