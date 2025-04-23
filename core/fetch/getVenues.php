<?php
require '../app.php';

@$sport = $_GET['sport'];

$db = new Database();

$vanues = $db->query("SELECT id_venue, venue FROM venues WHERE sport = '$sport' AND status = 'open'");
foreach($vanues as $venue){
    $data[] = $venue;
}

echo json_encode($data);
?>