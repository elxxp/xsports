<?php
require '../app.php';

if(isset($_POST['id_order_true'])){
    $order = new Order();

    if($order->verifyOrder($_POST['id_order_true'])){
        setcookie('verifySuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/verifikasi_pesanan');
    } else {
        setcookie('verifyFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/verifikasi_pesanan');
    }
} 
if(isset($_POST['id_order_false'])){
    $order = new Order();

    if($order->cancelOrder($_POST['id_order_false'])){
        setcookie('cancelSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/verifikasi_pesanan');
    } else {
        setcookie('cancelFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/verifikasi_pesanan');
    }
} 