<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
staffOnly();

$order = new Order();
$venue = new venue();
$account = new Account();

$getOrders = $order->getDataOrders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Daftar pesanan</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php require '../_partials/sidebar_dashboard.php'; ?>

    <div id="alertContainer">
        <?php if(@$_COOKIE['deleteSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Pesanan berhasil dihapus
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['deleteFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['cancelSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Pesanan berhasil dibatalkan
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['cancelFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>

    </div>

    <!-- content -->
    <div class="p-4 sm:ml-64">
    <div class="p-4 rounded-xl bg-white mt-14 shadow-sm">

    <table id="table_daftar_pesanan" class="text-xs">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        #ID
                    </span>
                </th>
                <th data-type="date" data-format="Month YYYY">
                    <span class="flex items-center">
                        venue & olahraga
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        jadwal penyewaan venue
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        kontak penyewa
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        pembayaran pesanan
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        bukti pembayaran
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        status pesanan
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if($getOrders->num_rows > 0): ?>
                <?php $ordinal = 0; foreach($getOrders as $order): $ordinal++; $status = $order['status']; $bukti_tipe_file = "image/jpeg"; $bukti_data = base64_encode($order['bukti']); ?>

                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">#<?= $order['id_order'] ?></td>
                        <td><?= $venue->getDataVenue($order['id_venue'])['venue'] ?></td>
                        <td><?= tanggalClean($order['tanggal_sewa']) ?></td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $order['name'] ?></td>
                        <td class="font-bold text-gray-900 whitespace-nowrap dark:text-white">Rp. <?= number_format($order['biaya']) ?> <?= strtoupper($order['payment']) ?></td>
                        <td>
                            <button data-modal-target="buktiModal<?= $ordinal ?>" data-modal-toggle="buktiModal<?= $ordinal ?>" class="transition cursor-pointer w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Lihat bukti</button>

                            <!-- bukti modal -->
                            <div id="buktiModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden pt-20 overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                    <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                                        <div class="mb-4 rounded-t sm:mb-5">
                                            <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                                                <h3 class="font-semibold">
                                                    Bukti pembayaran
                                                    <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                        #<?= $order['id_order'] ?> - <?= $order['waktu_order'] ?>
                                                    </p>
                                                </h3>
                                            </div>
                                        </div>
                                        <dl>
                                            <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                                                <dl>
                                                    <img src='data:<?= $bukti_tipe_file ?>;base64,<?= $bukti_data ?>' width="200">
                                                </dl>
                                            </div>
                                        </dl>

                                        <div>   
                                            <button type="button" data-modal-toggle="buktiModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600">
                                                Tutup
                                            </button>             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php if($status == 'active'): ?>
                                <dd class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                    Booking aktif
                                </dd>
                            <?php elseif($status == 'complete'): ?>
                                <dd class="inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Selesai
                                </dd>
                            <?php elseif($status == 'pending'): ?>
                                <dd class="inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                    Menunggu verifikasi
                                </dd>
                            <?php elseif($status == 'cancel'): ?>
                                <dd class="inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                    Dibatalkan
                                </dd>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button data-modal-target="detailModal<?= $ordinal ?>" data-modal-toggle="detailModal<?= $ordinal ?>" class="transition cursor-pointer w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">Detail</button>
                            <?php if($status == "pending"): ?>
                                <button data-modal-target="confirmModal<?= $ordinal ?>" data-modal-toggle="confirmModal<?= $ordinal ?>" class="transition w-full rounded-lg px-3 py-2 text-center text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white lg:w-auto"><i class="fa-regular fa-trash-can w-5"></i></button>

                                <!-- confirm modal -->
                                <div id="confirmModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="confirmModal<?= $ordinal ?>">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>

                                            <p class="mb-2 mt-1 font-semibold text-gray-500 dark:text-gray-300"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Hapus pesanan <span class="font-bold">#<?= $order['id_order'] ?></span> ?</p>
                                            <p class="mb-5 ml-2 text-sm text-gray-500 dark:text-gray-300">Pesanan yang dihapus tidak dapat dikembalikan kembali, dan data seluruh pesanan termasuk kontak penyewa juga akan terhapus. Yakin menghapus?</p>
                                            <div class="flex justify-end items-center space-x-2">
                                                <form action="../core/form/deleteOrder" method="post">
                                                    <input type="hidden" name="order" value="<?= $order['id_order'] ?>">
                                                    <button data-modal-toggle="confirmModal<?= $ordinal ?>" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        kembali
                                                    </button>
                                                    <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        hapus pesanan
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif($status == "active"): ?>
                                <button data-modal-target="confirmModal<?= $ordinal ?>" data-modal-toggle="confirmModal<?= $ordinal ?>" class="transition w-full rounded-lg px-3 py-2 text-center text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white lg:w-auto"><i class="fa-regular fa-flag w-5"></i></button>

                                <!-- confirm modal -->
                                <div id="confirmModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="confirmModal<?= $ordinal ?>">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>

                                            <p class="mb-2 mt-1 font-semibold text-gray-500 dark:text-gray-300"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Batalkan pesanan aktif <span class="font-bold">#<?= $order['id_order'] ?></span> ?</p>
                                            <p class="mb-5 ml-2 text-sm text-gray-500 dark:text-gray-300">Pesanan yang dibatalkan saat aktif tidak dapat dikembalikan kembali. Yakin membatalkan pesanan?</p>
                                            <div class="flex justify-end items-center space-x-2">
                                                <form action="../core/form/cancelOrder" method="post">
                                                    <input type="hidden" name="order_force" value="<?= $order['id_order'] ?>">
                                                    <button data-modal-toggle="confirmModal<?= $ordinal ?>" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        kembali
                                                    </button>
                                                    <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        batalkan booking
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- detail modal -->
                            <div id="detailModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
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
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">ID Akun</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">#<?= $order['id_user'] ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Email Akun</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $account->getDataUser($order['id_user'])['email'] ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">No. Telepon Akun</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $account->getDataUser($order['id_user'])['telephone'] ?></dd>
                                                </dl>
                                                <hr class="h-px my-5 bg-gray-200 border-0 dark:bg-gray-700">
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Atas nama</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $order['name'] ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Kontak email</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $order['email'] ?></dd>
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
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Tanggal booking</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= tanggalClean($order['tanggal_sewa']) ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Jadwal booking</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= substr($order['jam_mulai'], 0, 5) ?> - <?= substr($order['jam_selesai'], 0, 5) ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Total pembayaran</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Rp. <?= number_format($order['biaya']) ?></dd>
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
                                                        <?php endif; ?>
                                                    </dd>
                                                </dl>
                                            </div>
                                        </dl>

                                        <div>
                                            <button type="button" data-modal-toggle="detailModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600">
                                                Tutup
                                            </button>             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan=10>
                        <section>
                            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                                <div class="mx-auto max-w-screen-sm text-center">
                                    <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-600 dark:text-blue-500"><i class="fa-solid fa-snooze"></i></h1>
                                    <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Tidak ada pesanan</p>
                                </div>   
                            </div>
                        </section>
                    </td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                </tr>
            <?php endif; ?>
        </tbody>
        </table>

    </div>
<script src="../assets/js/main.js"></script>
<script>
if (document.getElementById("table_daftar_pesanan") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#table_daftar_pesanan", {
        paging: true,
        perPage: 10,
        perPageSelect: [10, 15, 20, 25],
        sortable: false
    });
}
</script>
</html>