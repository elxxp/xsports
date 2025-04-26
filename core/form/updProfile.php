<?php
session_start();
require '../app.php';

$account = new Account();

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(isset($_SESSION['s_id']) && isset($_SESSION['s_nama']) && isset($_SESSION['s_telp']) && isset($_SESSION['s_email']) && isset($_SESSION['level'])){
    if(isset($_POST['name']) && @$_POST['name']){
        if(isset($_POST['email']) && @$_POST['email']){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                if(isset($_POST['phone']) && @$_POST['phone']){
                    if(strlen($_POST['phone']) > 10 && strlen($_POST['phone']) < 14){
    
                        if($account->editUser($_SESSION['s_id'], $name, $email, $phone)){
    
                            setcookie('editProfileSuccess', 'ok', time() + 1, "/");
                            header("location: ../../views");
     
                        } else {
                            setcookie('editProfileFail', 'ok', time() + 1, "/");
                            header("location: ../../views");
                        }
    
                    } else {
                        setcookie('editProfileFail', 'ok', time() + 1, "/");
                        header("location: ../../views");
                    }
    
                } else {
                    setcookie('editProfileFail', 'ok', time() + 1, "/");
                    header("location: ../../views");
                }
    
            } else {
                setcookie('editProfileFail', 'ok', time() + 1, "/");
                header("location: ../../views");
            }
    
        } else {
            setcookie('editProfileFail', 'ok', time() + 1, "/");
            header("location: ../../views");
        }
    
    } else {
        setcookie('editProfileFail', 'ok', time() + 1, "/");
        header("location: ../../views");
    }
    
} else {
    setcookie('editProfileFail', 'ok', time() + 1, "/");
    header("location: ../../views");
}
