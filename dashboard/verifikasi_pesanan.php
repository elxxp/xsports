<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
staffOnly();

$order = new Order();
$venue = new Venue();

$getOrders = $order->getDataPendingOrders();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Verifikasi pesanan</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php require '../_partials/sidebar_dashboard.php'; ?>

    <div id="alertContainer">
        <?php if(@$_COOKIE['verifySuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Pesanan berhasil diverifikasi
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['verifyFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>
        <?php if(@$_COOKIE['cancelSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Pesanan berhasil dibatalkan
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['cencelFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>
    </div>

    <!-- content -->
    <div class="p-4 sm:ml-64">
    <div class="p-4 rounded-xl bg-white mt-14 shadow-sm">

    <table id="table_verifikasi_pembayaran" class="text-xs">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        #ID
                    </span>
                </th>
                <th data-type="date" data-format="Month YYYY">
                    <span class="flex items-center">
                        venue
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        jadwal
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        waktu sewa
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        tarif venue / jam
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        atas nama
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        total pembayaran
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        bukti pembayaran
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        metode pembayaran
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
                <?php $ordinal = 0; foreach($getOrders as $order): $ordinal++; $bukti_tipe_file = "image/jpeg"; $bukti_data = base64_encode($order['bukti']); ?>

                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">#<?= $order['id_order'] ?></td>
                        <td><?= $venue->getDataVenue($order['id_venue'])['venue'] ?></td>
                        <td><?= tanggalClean($order['tanggal_sewa']) ?></td>
                        <td><?= substr($order['jam_selesai'], 0, 2) - substr($order['jam_mulai'], 0, 2)  ?> Jam</td>
                        <td>Rp. <?= number_format($venue->getDataVenue($order['id_venue'])['tarif']) ?></td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $order['name'] ?></td>
                        <td class="font-bold text-gray-900 whitespace-nowrap dark:text-white">Rp. <?= number_format($order['biaya']) ?></td>
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
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Bank <?= strtoupper($order['payment']) ?></td>
                        <td>
                            <button data-modal-target="verifikasiModal<?= $ordinal ?>" data-modal-toggle="verifikasiModal<?= $ordinal ?>" class="transition cursor-pointer w-full rounded-lg bg-blue-700 px-3 py-2 text-sm font-medium text-white hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 lg:w-auto">Verifikasi</button>

                            <!-- verifikasi modal -->
                            <div id="verifikasiModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
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
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Rp. <?= number_format($order['biaya']) ?></dd>
                                                </dl>
                                                <dl class="sm:flex items-center justify-between gap-4">
                                                    <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Metode pembayaran</dt>
                                                    <dd class="font-medium text-gray-900 dark:text-white sm:text-end">Transfer bank <?= strtoupper($order['payment']) ?></dd>
                                                </dl>
                                            </div>
                                        </dl>

                                        <div>
                                            <form action="../core/form/verOrder" method="post">
                                                <input type="hidden" name="id_order_true" value="<?= $order['id_order'] ?>">
                                                <button class="mb-1 cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-white focus:outline-none bg-blue-600 rounded-lg border border-blue-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-blue-800 dark:bg-blue-600 dark:border-blue-200">
                                                    Tandai verifikasi berhasil 
                                                </button>             
                                            </form>
                                            <form action="../core/form/verOrder" method="post">
                                                <input type="hidden" name="id_order_false" value="<?= $order['id_order'] ?>">
                                                <button class="mb-1 cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-white focus:outline-none bg-red-600 rounded-lg border border-red-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-red-800 dark:bg-red-600 dark:border-red-200">
                                                    Tandai verifikasi gagal
                                                </button>             
                                            </form> 
                                            <button type="button" data-modal-toggle="verifikasiModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600">
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



        <div id="buktiModal1" tabindex="-1" aria-hidden="true" class="hidden pt-20 overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
            <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                <div class="mb-4 rounded-t sm:mb-5">
                    <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold">
                            Bukti pembayaran
                            <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                #1 - asas
                            </p>
                        </h3>
                    </div>
                </div>
                <dl>
                    <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                        <dl>
                            <img src="../assets/images/bukti_dummy.jpg" width="200">
                        </dl>
                    </div>
                </dl>

                <div>   
                    <button type="button" data-modal-toggle="buktiModal1" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600">
                        Tutup
                    </button>             
                </div>
            </div>
        </div>
    </div>
<script src="../assets/js/main.js"></script>
<script>
if (document.getElementById("table_verifikasi_pembayaran") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#table_verifikasi_pembayaran", {
        paging: true,
        perPage: 10,
        perPageSelect: [10, 15, 20, 25],
        sortable: false
    });
}
</script>
</html>