<?php 
require '../core/app.php';

$db = new Database();
$koneksi = $db->get();

$account = new Account($koneksi);
$account->logout();
?>