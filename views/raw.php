<?php
require '../core/app.php';

if(isset($_POST['book'])){
    $db = new Database();
    $conn = $db->get();

    $order = new Order($conn);
    $name = $_POST['nama'];
    $telp = $_POST['telephone'];
    $email = $_POST['email'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    
    $sport = $_POST['sport'];
    $venue = $_POST['venue'];

    $decs_jam_mulai = substr($jam_mulai, 0, 2);
    $decs_jam_selesai = substr($jam_selesai, 0, 2);
    echo $biaya = ($decs_jam_selesai - $decs_jam_mulai) * 10000;

    $order = new Order($conn);
    // $order->makeOrder($name, $telp, $email, $sport, $venue, $tanggal, $jam_mulai, $jam_selesai, 0);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <?php require '../_partials/head.html'; ?> -->
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label>Nama penyewa:</label><br>
        <input type="text" name="nama" ><br><br>
        <label>Telephone penyewa:</label><br>
        +62<input type="number" name="telephone" ><br><br>
        <label>Email penyewa:</label><br>
        <input type="email" name="email"><br><br>

        <label>Tanggal Sewa:</label><br>
        <input type="date" name="tanggal" ><br><br>

        <label>Jam Mulai:</label><br>
        <select name="jam_mulai" id="jam_mulai" onchange="updateJamSelesai()" >
            <option value="">-- Pilih Jam Mulai --</option>
            <?php
            for ($i = 7; $i <= 20; $i++) {
                $jam_view = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
                $jam_values = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00:00";
                echo "<option value=\"$jam_values\">$jam_view</option>";
            }
            ?>
        </select><br><br>

        <label>Jam Selesai:</label><br>
        <select name="jam_selesai" id="jam_selesai" disabled >
            <option value="">-- Pilih Jam Selesai --</option>
        </select><br><br>

        <input type="hidden" name="sport" value="a">
        <input type="hidden" name="venue" value="a">
        
        <button name="book">Booking</button>
    </form>
</body>
<script src="../assets/js/main.js"></script>
</html>

