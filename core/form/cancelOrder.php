<?php
require '../app.php';

if(isset($_POST['order'])){
    $order = new Order();

    if($order->cancelOrder($_POST['order'])){
        setcookie('cancelSuccess', 'ok', time() + 1, "/");
        header('location: ../../views/orders');
    } else {
        setcookie('cancelFail', 'ok', time() + 1, "/");
        header('location: ../../views/orders');
    }
} 

if(isset($_POST['order_force'])){
    $order = new Order();

    if($order->cancelOrder($_POST['order_force'])){
        setcookie('cancelSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_pesanan');
    } else {
        setcookie('cancelFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_pesanan');
    }
} 