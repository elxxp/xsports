<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
levelFilter();

if(isset($_POST['book']) && ($form_submited ?? false) == false) {
    $form_submited = true;

    $sport = $_POST['sport'];
    $id_venue = $_POST['venue'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $name = $_POST['nama'];
    $telp = $_POST['telp'];
    $email = $_POST['email'];

    $payment = $_POST['payment'];
    $buktiPayment = addslashes(file_get_contents($_FILES['bukti_pembayaran']['tmp_name']));

    $order = new Order();
    $venue = new Venue();
    
    $lama_sewa = substr($jam_selesai, 0, 2) - substr($jam_mulai, 0, 2);
    $biaya = $venue->getDataVenue($id_venue)['tarif'] * $lama_sewa;

    $buatOrder = $order->makeOrder($_SESSION['s_id'], $name, $telp, $email, $sport, $id_venue, $tanggal, $jam_mulai, $jam_selesai, $payment, $buktiPayment, $biaya);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Order <?= ($buatOrder) ? 'success' : 'failure' ?></title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php require '../_partials/navbar.php'; ?>

<?php
    if ($buatOrder) {
?>

        <section class="h-screen mt-20 antialiased md:py-8">
            <div class="text-center px-4 mx-auto max-w-xl">
                <i class="fa-solid fa-circle-check mb-3 text-6xl text-emerald-600 "></i>
                <h2 class="mb-1 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Pesanan berhasil dibuat!</h2>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Pesanan anda akan segara kami proses dalam 24 jam hari kerja.</p>
                <dl>
                    <div class="space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-white p-6 dark:border-gray-700 dark:bg-gray-800 mb-4 md:mb-6">
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Atas nama</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $name ?></dd>
                        </dl>
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">No. Telepon</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $telp ?></dd>
                        </dl>
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Jenis olahraga</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= ucfirst($sport) ?></dd>
                        </dl>
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Venue</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $venue->getDataVenue($id_venue)['venue'] ?></dd>
                        </dl>
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Jadwal booking</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $tanggal ?> <?= $jam_mulai ?>-<?= $jam_selesai ?></dd>
                        </dl>
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Total pembayaran</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Rp. <?= number_format($biaya)?></dd>
                        </dl>
                        <dl class="sm:flex items-center justify-between gap-4">
                            <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Metode pembayaran</dt>
                            <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Transfer bank <?= strtoupper($payment) ?></dd>
                        </dl>
                    </div>
                </dl>

                <div class="flex items-center space-x-4">
                    <a href="orders" class="w-full text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cek status booking</a>
                </div>  
            </div>
        </section>

    <?php

    } else {

    ?>

        <section class="h-screen mt-[25vh] antialiased md:py-8">
            <div class="text-center px-4 mx-auto max-w-xl">
                <i class="fa-solid fa-circle-xmark mb-3 text-6xl text-red-600"></i>
                <h2 class="mb-1 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Pesanan gagal dimuat</h2>
                <p class="text-gray-500 text-sm font-semibold mb-2 dark:text-gray-400 mb-1 md:mb-8">#INVALID REQUEST</p>
                <p class="text-gray-500 dark:text-gray-400 mb-6 md:mb-8">Terjadi kesalahan pada client saat mengisi formulir, pastikan isi formulir pesanan sesuai instruksi dan langkah yang tertera.</p>
        
        
                <div class="flex items-center space-x-4">
                    <a href="book" class="w-full text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Isi ulang formulir</a>
                </div>  
            </div>
        </section>

    <?php
    }
} else { header('location:book'); }
?>
</body>
<?php require '../_partials/footer.html'; ?>
</html>