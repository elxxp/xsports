<?php
require '../app.php';

if(isset($_POST['venue_delete'])){
    $venue = new Venue();

    if($venue->deleteVenue($_POST['venue_delete'])){
        setcookie('deleteVenueSuccess', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_venue');
    } else {
        setcookie('deleteVenueFail', 'ok', time() + 1, "/");
        header('location: ./../../dashboard/daftar_venue');
    }
} 