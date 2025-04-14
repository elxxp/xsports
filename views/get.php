<?php
if(isset($_POST['book'])){
    @$sport = $_POST['sport'];
    @$venue = $_POST['venue'];
    @$tanggal = $_POST['tanggal'];
    @$jam_mulai = $_POST['jam_mulai'];
    @$jam_selesai = $_POST['jam_selesai'];

    @$name = $_POST['nama'];
    @$telp = $_POST['telp'];
    @$email = $_POST['email'];

    @$payment = $_POST['payment'];

    // // Assuming you have a Database class to handle the connection
    // $db = new Database();
    // $conn = $db->get();

    // // Create an instance of the Order class
    // $order = new Order($conn);

    // // Call the makeOrder method
    // if ($order->makeOrder($name, $telephone, $email, $sport, $venue, $tanggal, $jam_mulai, $jam_selesai, $biaya)) {
    //     echo "Order placed successfully!";
    // } else {
    //     echo "Failed to place order.";
    // }
}
?>
Olahraga: <?= $sport ?><br>
Lapangan: <?= $venue ?><br>
Tanggal: <?= $tanggal ?><br>
Jam Mulai: <?= $jam_mulai ?><br>
Jam Selesai: <?= $jam_selesai ?><br>
Nama: <?= $name ?><br>
No. Telepon: <?= $telp ?><br>
Email: <?= $email ?><br>
Pembayaran: <?= $payment ?><br>
