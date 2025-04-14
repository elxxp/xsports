<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "xsports";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function get() {
        return $this->conn;
    }

    public function query($query) {
        $result = $this->conn->query($query);
        if ($result === false) {
            echo "Error: " . $this->conn->error;
            return false;
        }
        return $result;
    }
}

class Account {
    private $conn;
    private $table_name = "user";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($usermail, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = '$usermail' OR email = '$usermail' AND password = '$password'";
        return $this->conn->query($query);
    }

    public function register($username, $password) {
        if ($this->isAccAvailable($username)->num_rows > 0) {
            return false; // Username uda ada
        } else {
            $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES ('$username', '$password')";
            return $this->conn->query($query);
        }
    }

    private function isAccAvailable($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = '$username'";
        return $this->conn->query($query);
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../index.php');
    }
}

class Order {
    private $conn;
    private $table_name = "orders";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function makeOrder($name, $telephone, $email, $sport, $venue, $tanggal, $jam_mulai, $jam_selesai, $biaya) {
        $query = "INSERT INTO " . $this->table_name . " (name, telephone, email, sport, venue, tanggal_sewa, jam_mulai, jam_selesai, biaya, status) VALUES (
        '$name', 
        '$telephone',
        '$email', 
        '$sport',
        '$venue', 
        '$tanggal',
        '$jam_mulai',
        '$jam_selesai',
        '$biaya',
        'pending')";

        return $this->conn->query($query);
    }
}


?>