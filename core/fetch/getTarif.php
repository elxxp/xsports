<?php
require '../app.php';

@$id_venue = $_GET['id_venue'];

$db = new Database();
$koneksi = $db->get();

$vanues = $koneksi->query("SELECT id_venue, venue, tarif FROM venues WHERE id_venue = '$id_venue'");
foreach($vanues as $tarif){
    $data[] = $tarif;
}

echo json_encode($data);
?>