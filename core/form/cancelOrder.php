<?php
require '../app.php';

if(isset($_POST['order'])){
    $db = new Database();
    $koneksi = $db->get();
    $order = new Order($koneksi);

    if($order->cancelOrder($_POST['order'])){
        setcookie('cancelSuccess', 'ok', time() + 1, "/");
        header('location: ../../views/orders');
    } else {
        setcookie('cancelFail', 'ok', time() + 1, "/");
        header('location: ../../views/orders');
    }
} 