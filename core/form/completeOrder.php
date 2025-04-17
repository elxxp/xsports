<?php
require '../app.php';

if(isset($_POST['order'])){
    $db = new Database();
    $koneksi = $db->get();
    $order = new Order($koneksi);

    if($order->completeOrder($_POST['order'])){
        setcookie('completeSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_pesanan');
    } else {
        setcookie('completeFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_pesanan');
    }
} 