<?php
require '../app.php';

if(isset($_POST['account'])){
    $account = new Account();

    if($account->deleteUser($_POST['account'])){
        setcookie('deleteSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_akun');
    } else {
        setcookie('deleteFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_akun');
    }
} 