<?php
require '../app.php';

$db = new Database();

$olahraga = $_POST['olahraga'];
$venue = $_POST['venue'];
$tanggal = $_POST['tanggal'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

$sql = "SELECT * FROM orders 
        WHERE sport = '$olahraga'
        AND tanggal_sewa = '$tanggal'
        AND id_venue = '$venue'
        AND ('$jam_mulai' < jam_selesai AND '$jam_selesai' > jam_mulai)
        AND status = 'active'";

        $cek = $db->query($sql);
        if($cek->num_rows == 0) {
            $output = true;
            
        } else {
            $output = false;
        }

?>
<?= @$output ?>