<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
levelFilter();
$id_user = $_SESSION['s_id'];

$venue = new Venue();
$order = new Order();

$getOrders = $order->getDataOrder($id_user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Pesanan</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php require '../_partials/navbar.php'; ?>

    <div id="alertContainer">
        <?php if(@$_COOKIE['cancelSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Berhasil membatalkan pesanan
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['cancelFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>


    </div>

    <section class="py-8 mt-20 antialiased md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Pesanan saya</h2>
            </div>

            <div class="mt-6 flow-root sm:mt-8">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">

                    <?php if($getOrders->num_rows > 0): ?>
                        <?php $ordinal = 0; foreach($getOrders as $order): $status = $order['status']; $ordinal++; ?>
                            
                            <div class="flex flex-wrap items-top gap-y-4 py-6">
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Venue:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white"><?= $venue->getDataVenue($order['id_venue'])['venue'] ?></dd>
                                    <dd class="mt-1 text-xs font-normal text-gray-900 dark:text-white">Olahraga <?= ucfirst($order['sport']) ?></dd>
                                </dl>
        
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Jadwal:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white"><?= substr($order['jam_mulai'], 0, 5) ?> - <?= substr($order['jam_selesai'], 0, 5) ?></dd>
                                    <dd class="mt-1 text-xs font-normal text-gray-900 dark:text-white text-sm"><?= tanggalClean($order['tanggal_sewa']) ?></dd>
                                </dl>
                            
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Harga:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-emerald-600 dark:text-emerald-400">Rp, <?= number_format($order['biaya']) ?></dd>
                                    <dd class="mt-1 text-xs font-normal text-gray-900 dark:text-white text-sm">Rp, <?= number_format($venue->getDataVenue($order['id_venue'])['tarif']) ?>/jam</dd>
                                </dl>
                            
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>

                                    <?php if($status == 'active'): ?>
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            Booking aktif
                                        </dd>
                                    <?php elseif($status == 'complete'): ?>
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Selesai
                                        </dd>
                                    <?php elseif($status == 'pending'): ?>
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            Menunggu verifikasi
                                        </dd>
                                    <?php elseif($status == 'cancel'): ?>
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Dibatalkan
                                        </dd>
                                    <?php elseif($status == 'expired'): ?>
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                            Verifikasi kadaluarsa
                                        </dd>
                                    <?php endif; ?>
                                </dl>

                                <?php if($status == 'active'): ?>
                                    <div class="w-full grid lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                        <button data-modal-target="readProductModal<?= $ordinal ?>" data-modal-toggle="readProductModal<?= $ordinal ?>" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Detail pesanan</a>
                                    </div>
                                <?php elseif($status == 'complete' || $status == "cancel"): ?>
                                    <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                        <a href="book?autofill_sport=<?= $order['sport'] ?>&autofill_venue=<?= $order['id_venue'] ?>" type="button" class="w-full rounded-lg bg-blue-700 px-3 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 lg:w-auto">Booking lagi</a>
                                        <button data-modal-target="readProductModal<?= $ordinal ?>" data-modal-toggle="readProductModal<?= $ordinal ?>" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Detail pesanan</a>
                                    </div>
                                <?php elseif($status == "expired"): ?>
                                    <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                        <a href="book?autofill_sport=<?= $order['sport'] ?>&autofill_venue=<?= $order['id_venue'] ?>" type="button" class="w-full rounded-lg bg-blue-700 px-3 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 lg:w-auto">Booking ulang</a>
                                        <button data-modal-target="readProductModal<?= $ordinal ?>" data-modal-toggle="readProductModal<?= $ordinal ?>" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Detail pesanan</a>
                                    </div>
                                <?php elseif($status == 'pending'): ?>
                                    <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                                        <button data-modal-target="confirmModal<?= $ordinal ?>" data-modal-toggle="confirmModal<?= $ordinal ?>" class="w-full rounded-lg border border-red-700 px-3 py-2 text-center text-sm font-medium text-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-300 dark:border-red-500 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white dark:focus:ring-red-900 lg:w-auto">Batalkan booking</button>
                                        <button data-modal-target="readProductModal<?= $ordinal ?>" data-modal-toggle="readProductModal<?= $ordinal ?>" class="w-full inline-flex justify-center rounded-lg  border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Detail pesanan</a>
                                    </div>

                                    <!-- Modal confirm -->
                                    <div id="confirmModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="confirmModal<?= $ordinal ?>">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>

                                                <p class="mb-2 mt-1 font-semibold text-gray-500 dark:text-gray-300"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Batalkan pesanan?</p>
                                                <p class="mb-5 ml-2 text-sm text-gray-500 dark:text-gray-300">Pesanan yang dibatalkan tidak dapat dikembalikan kembali, dan beresiko masalah proses pembayaran.</p>
                                                <div class="flex justify-end items-center space-x-2">
                                                    <form action="../core/form/cancelOrder" method="post">
                                                        <input type="hidden" name="order" value="<?= $order['id_order'] ?>">
                                                        <button class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                            batalkan booking
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Modal detail -->
                            <div id="readProductModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                                        <div class="mb-4 rounded-t sm:mb-5">
                                            <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                                                <h3 class="font-semibold">
                                                    Detail Pesanan
                                                    <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                        #<?= $order['id_order'] ?> - <?= $order['waktu_order'] ?>
                                                    </p>
                                                </h3>
                                            </div>
                                        </div>
                                        <dl>
                                            <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Atas nama</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $order['name'] ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">No. Telepon</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $order['telephone'] ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Jenis olahraga</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= ucfirst($order['sport']) ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Venue</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $venue->getDataVenue($order['id_venue'])['venue'] ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Jadwal booking</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $order['tanggal_sewa'] ?> <?= substr($order['jam_mulai'], 0, 5) ?>-<?= substr($order['jam_selesai'], 0, 5) ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Total pembayaran</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Rp. <?= number_format($order['biaya'] )?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Metode pembayaran</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Transfer bank <?= strtoupper($order['payment']) ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Status pesanan</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">
                                                        <?php if($status == 'active'): ?>
                                                            <dd class="mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                                                Booking aktif
                                                            </dd>
                                                        <?php elseif($status == 'complete'): ?>
                                                            <dd class="mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                                                Selesai
                                                            </dd>
                                                        <?php elseif($status == 'pending'): ?>
                                                            <dd class="mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                                                Menunggu verifikasi
                                                            </dd>
                                                        <?php elseif($status == 'cancel'): ?>
                                                            <dd class="mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                                                Dibatalkan
                                                            </dd>
                                                        <?php elseif($status == 'expired'): ?>
                                                            <dd class="mt-1.5 inline-flex items-center rounded bg-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                                                Verifikasi kadaluarsa
                                                            </dd>
                                                        <?php endif; ?>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </dl>

                                        <div class="flex justify-between items-center">              
                                            <button type="button" data-modal-toggle="readProductModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Close
                                            </button>             
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        
                        <section class="flex items-center h-[70vh]">
                            <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
                                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Jelajahi venue yang cocok untuk mu</h1>
                                <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">Anda tidak memiliki catatan pesanan karena belum booking venue kami, mari lihat yang sesuai untuk dibooking</p>
                                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                                    <a href="venues" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                        Daftar venue kami
                                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </section>

                    <?php endif; ?>
                </div>
            </div>
            </div>
        </div>
    </section>
    
</body>
<script src="../assets/js/main.js"></script>
</html>