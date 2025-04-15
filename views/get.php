<?php
session_start();
require '../core/app.php';

if(isset($_POST['book'])){
    $sport = $_POST['sport'];
    $id_venue = $_POST['venue'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $name = $_POST['nama'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    $payment = $_POST['payment'];
    $buktiPayment = addslashes(file_get_contents($_FILES['bukti_pembayaran']['tmp_name']));

    $db = new Database();
    $koneksi = $db->get();
    $order = new Order($koneksi);
    
    $lama_sewa = substr($jam_selesai, 0, 2) - substr($jam_mulai, 0, 2);
    $biaya = $db->getDataVenues($id_venue)['tarif'] * $lama_sewa;

    if ($order->makeOrder($_SESSION['s_id'], $name, $telp, $email, $sport, $id_venue, $tanggal, $jam_mulai, $jam_selesai, $payment, $buktiPayment, $biaya)) {
        echo "Order placed successfully!";
    } else {
        echo "Failed to place order.";
    }
}
?>

