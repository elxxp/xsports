<?php
require '../app.php';

if(isset($_POST['venue_open'])){
    $db = new Database();

    if($db->openVenue($_POST['venue_open'])){
        setcookie('openVenueSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_venue');
    } else {
        setcookie('openVenueFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_venue');
    }
} 

if(isset($_POST['venue_close'])){
    $db = new Database();

    if($db->closeVenue($_POST['venue_close'])){
        setcookie('closeVenueSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_venue');
    } else {
        setcookie('closeVenueFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_venue');
    }
} 