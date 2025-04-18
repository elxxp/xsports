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

        $update_status_sql = $sql = "UPDATE orders 
                                     SET status = 'complete' 
                                     WHERE status = 'active' 
                                     AND CONCAT(tanggal_sewa, ' ', jam_selesai) < NOW()";

        $this->conn->query($update_status_sql);
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

    public function getDataVenues($id_venue){
        $output = $this->conn->query("SELECT * FROM venues WHERE id_venue = '$id_venue'");
        return $output->fetch_assoc();
    }

    public function getDataUser($id_user){
        $output = $this->conn->query("SELECT * FROM user WHERE id_user = '$id_user'");
        return $output->fetch_assoc();
    }

    public function openVenue($id_venue){
        $query = "UPDATE venues SET status = 'open' WHERE id_venue = $id_venue";
        return $this->conn->query($query);
    }

    public function closeVenue($id_venue){
        $query = "UPDATE venues SET status = 'closed' WHERE id_venue = $id_venue";
        return $this->conn->query($query);
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

    public function makeOrder($id_user, $name, $telephone, $email, $sport, $id_venue, $tanggal_sewa, $jam_mulai, $jam_selesai, $payment, $bukti, $biaya) {
        $query = "INSERT INTO " . $this->table_name . " (id_user, name, telephone, email, sport, id_venue, tanggal_sewa, jam_mulai, jam_selesai, payment, bukti, biaya, status) VALUES (
        $id_user,
        '$name',
        '$telephone',
        '$email', 
        '$sport',
        $id_venue, 
        '$tanggal_sewa',
        '$jam_mulai',
        '$jam_selesai',
        '$payment',
        '$bukti',
        $biaya,
        'pending')";

        return $this->conn->query($query);
    }

    public function deleteOrder($id_order) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_order = $id_order";
        return $this->conn->query($query);
    }

    public function cancelOrder($id_order){
        $query = "UPDATE " . $this->table_name . " SET status = 'cancel' WHERE id_order = $id_order";
        return $this->conn->query($query);
    }

    public function verifyOrder($id_order){
        $query = "UPDATE " . $this->table_name . " SET status = 'active' WHERE id_order = $id_order";
        return $this->conn->query($query);
    }

    public function completeOrder($id_order){
        $query = "UPDATE " . $this->table_name . " SET status = 'complete' WHERE id_order = $id_order";
        return $this->conn->query($query);
    }
}
?>