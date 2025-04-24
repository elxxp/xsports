<?php
require '../app.php';

if(isset($_POST['level']) && isset($_POST['user'])){
    $account = new Account();

    if($account->changeLevel($_POST['user'], $_POST['level'])){
        setcookie('updateSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_akun');
    } else {
        setcookie('updateFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_akun');
    }
} 