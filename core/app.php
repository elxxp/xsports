<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "xsports";
    protected $koneksi;

    public function __construct() {
        $this->koneksi = new mysqli($this->host, $this->user, $this->pass, $this->name);

        if ($this->koneksi->connect_error) {
            die("Koneksi gagal: " . $this->koneksi->connect_error);
        }

        $update_status_orders_sql = "UPDATE orders 
                                     SET status = 'complete' 
                                     WHERE status = 'active' 
                                     AND CONCAT(tanggal_sewa, ' ', jam_selesai) < NOW()";
        $this->koneksi->query($update_status_orders_sql);
        
        $update_expired_orders_sql = "UPDATE orders 
                                     SET status = 'expired' 
                                     WHERE status = 'pending' 
                                     AND CONCAT(tanggal_sewa, ' ', jam_selesai) < NOW()";
        $this->koneksi->query($update_expired_orders_sql);
    }

    public function query($query) {
        $result = $this->koneksi->query($query);
        if ($result === false) {
            echo "Error: " . $this->koneksi->error;
            return false;
        }
        return $result;
    }
}

class Account extends Database {
    private $table_name = "user";

    public function getDataUsers($current_id_user){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user != '$current_id_user' ORDER BY waktu_daftar DESC";
        return $this->koneksi->query($query);
    }
    
    public function getDataUser($id_user){
        $output = $this->koneksi->query("SELECT * FROM " . $this->table_name . " WHERE id_user = '$id_user'");
        return $output->fetch_assoc();
    }

    public function editUser($id_user, $name, $usermail, $phone){
        $query = "UPDATE " . $this->table_name . " SET name = '$name', email = '$usermail', telephone = '$phone' WHERE id_user = $id_user";
        return $this->koneksi->query($query);
    }

    public function editPassword($id_user, $passwordOld, $passwordNew){
        if($this->cekPassword($id_user, $passwordOld)->num_rows > 0){
            $query = "UPDATE " . $this->table_name . " SET password = '$passwordNew' WHERE id_user = $id_user";
            return $this->koneksi->query($query);
        } else {
            return false;
        }
    }

    private function cekPassword($id_user, $passwordOld){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = '$id_user' AND password = '$passwordOld'";
        return $this->koneksi->query($query);
    }

    public function deleteUser($id_user){
        $query = "DELETE FROM " . $this->table_name . " WHERE id_user = $id_user";
        return $this->koneksi->query($query);
    }

    public function changeLevel($id_user, $level){
        $query = "UPDATE " . $this->table_name . " SET level = '$level' WHERE id_user = $id_user";
        return $this->koneksi->query($query);
    }
    
    public function login($usermail, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '$usermail' AND password = '$password'";
        return $this->koneksi->query($query);
    }

    public function register($name, $usermail, $phone, $password) {
        if ($this->isAccAvailable($usermail)->num_rows > 0) {
            return false;
        } else {
            $query = "INSERT INTO " . $this->table_name . " (email, name, telephone, password, level) VALUES ('$usermail', '$name', '$phone', '$password', 'guest')";
            return $this->koneksi->query($query);
        }
    }

    private function isAccAvailable($usermail) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '$usermail'";
        return $this->koneksi->query($query);
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../views');
    }
}

class Order extends Database {
    private $table_name = "orders";

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

        return $this->koneksi->query($query);
    }

    public function getDataOrders(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY waktu_order DESC";
        return $this->koneksi->query($query);
    }

    public function getDataPendingOrders(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE status = 'pending' ORDER BY id_order DESC";
        return $this->koneksi->query($query);
    }
    
    public function getDataOrder($id_user){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = $id_user ORDER BY waktu_order DESC";
        return $this->koneksi->query($query);
    }

    public function deleteOrder($id_order) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_order = $id_order";
        return $this->koneksi->query($query);
    }

    public function cancelOrder($id_order){
        $query = "UPDATE " . $this->table_name . " SET status = 'cancel' WHERE id_order = $id_order";
        return $this->koneksi->query($query);
    }

    public function verifyOrder($id_order){
        $query = "UPDATE " . $this->table_name . " SET status = 'active' WHERE id_order = $id_order";
        return $this->koneksi->query($query);
    }
}

class Venue extends Database {
    private $table_name = "venues";

    public function getDataVenues($filter){
        if($filter == 'all'){
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY waktu_buat DESC";
            return $this->koneksi->query($query);
        } else {            
            $query = "SELECT * FROM " . $this->table_name . " WHERE sport = '$filter' ORDER BY waktu_buat DESC";
            return $this->koneksi->query($query);
        }
    }

    public function getDataVenue($id_venue){
        $output = $this->koneksi->query("SELECT * FROM " . $this->table_name . " WHERE id_venue = '$id_venue'");
        return $output->fetch_assoc();
    }

    public function updateVenue($id_venue, $nama, $olahraga, $tarif, $status, $thumbnail, $deskripsi){
        $query = "UPDATE " . $this->table_name . " SET venue = '$nama', sport = '$olahraga', tarif = '$tarif', status = '$status', thumbnail = '$thumbnail', description = '$deskripsi', waktu_update = CURRENT_TIMESTAMP WHERE id_venue = $id_venue";
        return $this->koneksi->query($query);
    }

    public function deleteVenue($id_venue){
        $query = "DELETE FROM " . $this->table_name . " WHERE id_venue = $id_venue";
        return $this->koneksi->query($query);
    }

    public function makeVenue($nama, $olahraga, $tarif, $status, $thumbnail, $deskripsi){
        $query = "INSERT INTO " . $this->table_name . " (venue, sport, tarif, status, thumbnail, description) VALUES ('$nama', '$olahraga', '$tarif', '$status', '$thumbnail', '$deskripsi')";
        return $this->koneksi->query($query);
    }

    public function openVenue($id_venue){
        $query = "UPDATE " . $this->table_name . " SET status = 'open' WHERE id_venue = $id_venue";
        return $this->koneksi->query($query);
    }

    public function closeVenue($id_venue){
        $query = "UPDATE " . $this->table_name . " SET status = 'closed' WHERE id_venue = $id_venue";
        return $this->koneksi->query($query);
    }
}
?>