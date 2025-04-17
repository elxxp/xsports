<?php
require '../app.php';

if(isset($_POST['order'])){
    $db = new Database();
    $koneksi = $db->get();
    $order = new Order($koneksi);

    if($order->deleteOrder($_POST['order'])){
        setcookie('deleteSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_pesanan');
    } else {
        setcookie('deleteFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_pesanan');
    }
} 