<?php
session_start();
require '../app.php';

$account = new Account();

$passOld = $_POST['passOld'];
$passNew = $_POST['passCurr'];

if($account->editPassword($_SESSION['s_id'], md5($passOld), md5($passNew))){
    session_unset();
    session_destroy();
    echo 'true';
} else {
    echo '<div class="font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1"><i class="fa-solid fa-circle-exclamation mr-2"></i>Password lama salah, coba lagi</div>';
}