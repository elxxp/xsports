<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
staffOnly();

$db = new Database();
$orderPending = $db->query("SELECT COUNT(*) AS data FROM orders WHERE status = 'pending'");
$orderActive = $db->query("SELECT COUNT(*) AS data FROM orders WHERE status = 'active'");
$orderComplete = $db->query("SELECT COUNT(*) AS data FROM orders WHERE status = 'complete'");
$orderProblem = $db->query("SELECT COUNT(*) AS data FROM orders WHERE status = 'cancel' OR status = 'expired'");
$incomeTotal = $db->query("SELECT SUM(biaya) AS data FROM orders WHERE status = 'complete'");
$orderTotal = $db->query("SELECT COUNT(*) AS data FROM orders");
$userTotal = $db->query("SELECT COUNT(*) AS data FROM user");
$venueTotal = $db->query("SELECT COUNT(*) AS data FROM venues");

$populerVenueSQL = $db->query("SELECT id_venue, COUNT(*) as total_order, SUM(biaya) as total_income
                            FROM orders
                            WHERE status = 'complete'
                            GROUP BY id_venue
                            ORDER BY total_order DESC
                            LIMIT 1");
$dataPopuler = $populerVenueSQL->fetch_assoc();
$venue = new Venue();

$latestOrders = $db->query("SELECT * FROM orders ORDER BY waktu_order DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Dashboard</title>
</head>
<body class="bg-slate-100 ">
    <?php require '../_partials/sidebar_dashboard.php'; ?>
    <div id="alertContainer">
        <?php if(@$_COOKIE['editProfileSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 /20 border border-green-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Berhasil memperbarui informasi akun
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['editProfileFail']): ?>
            <div id="alertNontification" class="lertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 /20 border border-red-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Client error, coba lagi
            </div>
        <?php endif; ?>
    </div>

    <!-- content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg mt-14">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div>
                    <i class="fa-light fa-cart-circle-arrow-down text-gray-400 mb-1 text-xl"></i>
                    <h3 class="mb-2 text-gray-500 ">Pesanan masuk</h3>
                    <p class="flex ml-1 text-amber-600 items-end text-2xl font-bold ">
                        <?= $orderPending->fetch_assoc()['data'] ?> 
                        <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan</span>
                    </p>
                    <a href="verifikasi_pesanan" class="transition cursor-pointer w-full inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1 mt-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">
                        Verifikasi sekarang <i class="fa-regular fa-arrow-right text-xs ml-1.5"></i>
                    </a>

                </div>
            </div>

            <div class="flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div>
                    <i class="fa-light fa-cart-circle-arrow-up text-gray-400 mb-1 text-xl"></i>
                    <h3 class="mb-2 text-gray-500 ">Booking aktif</h3>
                    <p class="flex ml-1 text-blue-600 items-end text-2xl font-bold ">
                            <?= $orderActive->fetch_assoc()['data'] ?> 
                        <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan</span>
                    </p>
                    <a href="daftar_pesanan" class="transition cursor-pointer w-full inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1 mt-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">
                        Cek pesanan <i class="fa-regular fa-arrow-right text-xs ml-1.5"></i>
                    </a>

                </div>
            </div>

            <div class="flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div>
                    <i class="fa-light fa-cart-circle-check text-gray-400 mb-1 text-xl"></i>
                    <h3 class="mb-2 text-gray-500 ">Pesanan selesai</h3>
                    <p class="flex ml-1 text-green-600 items-end text-2xl font-bold ">
                        <?= $orderComplete->fetch_assoc()['data'] ?> 
                        <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan</span>
                    </p>
                    <a href="daftar_pesanan" class="transition cursor-pointer w-full inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1 mt-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">
                        Cek pesanan <i class="fa-regular fa-arrow-right text-xs ml-1.5"></i>
                    </a>

                </div>
            </div>
                
            <div class="flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div>
                    <i class="fa-light fa-cart-circle-xmark text-gray-400 mb-1 text-xl"></i>
                    <h3 class="mb-2 text-gray-500 ">Pesanan bermasalah</h3>
                    <p class="flex ml-1 text-red-600 items-end text-2xl font-bold text-gray-900 ">
                        <?= $orderProblem->fetch_assoc()['data'] ?> 
                        <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan</span>
                    </p>
                    <a href="daftar_pesanan" class="transition cursor-pointer w-full inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1 mt-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">
                        Cek pesanan <i class="fa-regular fa-arrow-right text-xs ml-1.5"></i>
                    </a>

                </div>
            </div>
            
            <div class="col-span-2 flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div class="flex items-center gap-15">
                    <div>
                        <h3 class="mb-2 text-gray-500 ">Total pendapatan bersih</h3>
                        <p class="flex ml-1 text-green-500 items-end text-2xl font-bold">
                            <span class="mr-1 mb-0.5 text-sm text-gray-800">Rp.</span>
                            <?php $rowIncome = $incomeTotal->fetch_assoc(); ?>
                            <?= (!empty($rowIncome['data'])) ? number_format($rowIncome['data']) : "0" ?>
                            <span class="ml-2 mb-0.5 text-sm text-gray-800">,-</span>
    
                        </p>
                        <h3 class="mt-7 mb-2 text-gray-500 ">Total seluruh pemesanan</h3>
                        <p class="flex ml-1 text-blue-500 items-end text-2xl font-bold">
                        <?php $rowOrder = $orderTotal->fetch_assoc(); ?>
                        <?= (!empty($rowOrder['data'])) ? number_format($rowOrder['data']) : "0" ?>
                            <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan</span>
                        </p>
                    </div>

                    <?php if($populerVenueSQL->num_rows > 0): ?>
                    <div>
                        <h3 class="mb-2 text-gray-500 ">Venue terpopuler</h3>
                        <p class="flex text-slate-800 items-end text-2xl font-bold text-nowrap overflow-hidden text-ellipsis">
                            <?= $venue->getDataVenue($dataPopuler['id_venue'])['venue'] ?>
                        </p>
                        <p class="flex items-center mt-0.5 text-slate-500 items-end text-sm font-semibold">
                            <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  ">
                                <i class="fa-solid fa-hashtag text-[10px] mr-1.5"></i><?= $dataPopuler['id_venue'] ?>
                            </span>

                            <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  ">
                                <i class="fa-solid fa-bowling-ball-pin text-[10px] mr-1.5"></i><?= ucfirst($venue->getDataVenue($dataPopuler['id_venue'])['sport']) ?>
                            </span>

                            <?php if($venue->getDataVenue($dataPopuler['id_venue'])['status'] == 'open'): ?>
                                <span class="flex items-center w-fit bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  ">
                                    Open
                                </span>
                            <?php elseif($venue->getDataVenue($dataPopuler['id_venue'])['status'] == 'closed'): ?>
                                <span class="flex items-center w-fit bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">
                                    Close
                                </span>
                            <?php endif; ?>
                        </p>
                        <p class="flex mt-4 text-slate-800 items-end text-2xl font-bold">
                            <?= $dataPopuler['total_order'] ?>±
                            <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan selesai</span>
                        </p>
                        <p class="flex text-purple-500 items-end text-2xl font-bold">
                            <?= number_format(($dataPopuler['total_income'] / $rowIncome['data']) * 100, 2) ?>%
                            <span class="ml-2 mb-0.5 text-sm text-gray-800">Dari total pendapatan</span>
                        </p>
                    </div>
                    <?php else: ?>
                    <div>
                        <h3 class="mb-2 text-gray-500 ">Venue terpopuler</h3>
                        <p class="flex text-slate-800 items-end text-2xl font-bold text-nowrap overflow-hidden text-ellipsis">
                            -
                        </p>
                        <p class="flex items-center mt-0.5 text-slate-500 items-end text-sm font-semibold">
                            <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  ">
                                <i class="fa-solid fa-hashtag text-[10px] mr-1.5"></i>???
                            </span>

                            <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full  ">
                                <i class="fa-solid fa-bowling-ball-pin text-[10px] mr-1.5"></i>???
                            </span>

                            <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">
                                ???
                            </span>
                        </p>
                        <p class="flex mt-4 text-slate-800 items-end text-2xl font-bold">
                            -±
                            <span class="ml-2 mb-0.5 text-sm text-gray-800">Pesanan selesai</span>
                        </p>
                        <p class="flex text-purple-500 items-end text-2xl font-bold">
                            -%
                            <span class="ml-2 mb-0.5 text-sm text-gray-800">Dari total pendapatan</span>
                        </p>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <div class="flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div>
                    <i class="fa-light fa-users text-gray-400 mb-1 text-xl"></i>
                    <h3 class="mb-2 text-gray-500 ">Pengguna terdaftar</h3>
                    <p class="flex ml-1 text-slate-800 items-end text-2xl font-bold">
                        <?= $userTotal->fetch_assoc()['data'] ?> 
                        <span class="ml-2 mb-0.5 text-sm text-gray-800">Total user</span>
                    </p>
                    <a href="daftar_akun" class="transition cursor-pointer w-full inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1 mt-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">
                        Cek daftar pengguna <i class="fa-regular fa-arrow-right text-xs ml-1.5"></i>
                    </a>

                </div>
            </div>

            <div class="flex items-center justify-start bg-white pl-15 rounded-lg shadow-sm h-32 md:h-64">
                <div>
                    <i class="fa-light fa-table-tennis-paddle-ball text-gray-400 mb-1 text-xl"></i>
                    <h3 class="mb-2 text-gray-500 ">Daftar lapangan</h3>
                    <p class="flex ml-1 text-slate-800 items-end text-2xl font-bold">
                        <?= $venueTotal->fetch_assoc()['data'] ?> 
                        <span class="ml-2 mb-0.5 text-sm text-gray-800">Total venue tercatat</span>
                    </p>
                    <a href="daftar_venue" class="transition cursor-pointer w-full inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1 mt-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">
                        Cek daftar lapangan <i class="fa-regular fa-arrow-right text-xs ml-1.5"></i>
                    </a>

                </div>
            </div>
        </div>    

        <div class="bg-white rounded-lg shadow-sm px-10 py-12">
            <h1 class="text-xl text-black font-bold">Pesanan terbaru</h1>
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
                    <?php if($latestOrders->num_rows > 0): ?>
                        <?php $ordinal = 0; foreach($latestOrders as $order): $ordinal++; $status = $order['status']; $bukti_tipe_file = "image/jpeg"; $bukti_data = @base64_encode($order['bukti']); ?>
    
                            <tr>
                                <td class="font-medium text-gray-900 whitespace-nowrap ">#<?= $order['id_order'] ?></td>
                                <td><?= $venue->getDataVenue($order['id_venue'])['venue'] ?></td>
                                <td><?= tanggalClean($order['tanggal_sewa']) ?></td>
                                <td class="font-medium text-gray-900 whitespace-nowrap "><?= $order['name'] ?></td>
                                <td class="font-bold text-gray-900 whitespace-nowrap ">Rp. <?= number_format($order['biaya']) ?> <?= strtoupper($order['payment']) ?></td>
                                <td>
                                    <button data-modal-target="buktiModal<?= $ordinal ?>" data-modal-toggle="buktiModal<?= $ordinal ?>" class="transition cursor-pointer w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">Lihat bukti</button>
    
                                    <!-- bukti modal -->
                                    <div id="buktiModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden pt-20 overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                            <div class="relative p-5 bg-white rounded-lg shadow  sm:p-6">
                                                <div class="mb-4 rounded-t sm:mb-5">
                                                    <div class="flex items-center text-lg text-gray-900 md:text-xl ">
                                                        <h3 class="font-semibold">
                                                            Bukti pembayaran
                                                            <p class="text-xs font-normal text-gray-500 ">
                                                                #<?= $order['id_order'] ?> - <?= $order['waktu_order'] ?>
                                                            </p>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <dl>
                                                    <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5   mb-6 md:mb-8">
                                                        <dl>
                                                            <img src='data:<?= $bukti_tipe_file ?>;base64,<?= $bukti_data ?>' width="200">
                                                        </dl>
                                                    </div>
                                                </dl>
    
                                                <div>   
                                                    <button type="button" data-modal-toggle="buktiModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 :ring-gray-700   ">
                                                        Tutup
                                                    </button>             
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap ">
                                    <?php if($status == 'active'): ?>
                                        <dd class="inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800  ">
                                            Booking aktif
                                        </dd>
                                    <?php elseif($status == 'complete'): ?>
                                        <dd class="inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800  ">
                                            Selesai
                                        </dd>
                                    <?php elseif($status == 'pending'): ?>
                                        <dd class="inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800  ">
                                            Menunggu verifikasi
                                        </dd>
                                    <?php elseif($status == 'cancel'): ?>
                                        <dd class="inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800  ">
                                            Dibatalkan
                                        </dd>
                                    <?php elseif($status == 'expired'): ?>
                                        <dd class="inline-flex items-center rounded bg-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-800  ">
                                            Verifikasi kadaluarsa
                                        </dd>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button data-modal-target="detailModal<?= $ordinal ?>" data-modal-toggle="detailModal<?= $ordinal ?>" class="transition cursor-pointer w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100    :bg-gray-700 :text-white :ring-gray-700 lg:w-auto">Detail</button>
    
                                    <!-- detail modal -->
                                    <div id="detailModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                            <div class="relative p-5 bg-white rounded-lg shadow  sm:p-6">
                                                <div class="mb-4 rounded-t sm:mb-5">
                                                    <div class="flex items-center text-lg text-gray-900 md:text-xl ">
                                                        <h3 class="font-semibold">
                                                            Detail Pesanan
                                                            <p class="text-xs font-normal text-gray-500 ">
                                                                #<?= $order['id_order'] ?> - <?= $order['waktu_order'] ?>
                                                            </p>
                                                        </h3>
                                                    </div>
                                                </div>
                                                <dl>
                                                    <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5   mb-6 md:mb-8">
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">ID Akun</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end">#<?= $order['id_user'] ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Email Akun</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= $account->getDataUser($order['id_user'])['email'] ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">No. Telepon Akun</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= $account->getDataUser($order['id_user'])['telephone'] ?></dd>
                                                        </dl>
                                                        <hr class="h-px my-5 bg-gray-200 border-0 ">
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Atas nama</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= $order['name'] ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Kontak email</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= $order['email'] ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">No. Telepon</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= $order['telephone'] ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Jenis olahraga</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= ucfirst($order['sport']) ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Venue</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= $venue->getDataVenue($order['id_venue'])['venue'] ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Tanggal booking</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= tanggalClean($order['tanggal_sewa']) ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Jadwal booking</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end"><?= substr($order['jam_mulai'], 0, 5) ?> - <?= substr($order['jam_selesai'], 0, 5) ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Total pembayaran</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end">Rp. <?= number_format($order['biaya']) ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Metode pembayaran</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end">Transfer bank <?= strtoupper($order['payment']) ?></dd>
                                                        </dl>
                                                        <dl class="sm:flex items-center justify-between gap-4">
                                                            <dt class="font-normal sm:mb-0 text-gray-500 ">Status pesanan</dt>
                                                            <dd class="font-medium text-gray-900  sm:text-end">
                                                                <?php if($status == 'active'): ?>
                                                                    <dd class="mt-1.5 inline-flex items-center rounded bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800  ">
                                                                        Booking aktif
                                                                    </dd>
                                                                <?php elseif($status == 'complete'): ?>
                                                                    <dd class="mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800  ">
                                                                        Selesai
                                                                    </dd>
                                                                <?php elseif($status == 'pending'): ?>
                                                                    <dd class="mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-yellow-800  ">
                                                                        Menunggu verifikasi
                                                                    </dd>
                                                                <?php elseif($status == 'cancel'): ?>
                                                                    <dd class="mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800  ">
                                                                        Dibatalkan
                                                                    </dd>
                                                                <?php elseif($status == 'expired'): ?>
                                                                    <dd class="mt-1.5 inline-flex items-center rounded bg-gray-200 px-2.5 py-0.5 text-xs font-medium text-gray-800  ">
                                                                        Verifikasi kadaluarsa
                                                                    </dd>
                                                                <?php endif; ?>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                </dl>
    
                                                <div>
                                                    <button type="button" data-modal-toggle="detailModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 :ring-gray-700   ">
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
                            <td colspan=8>
                                <section>
                                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                                        <div class="mx-auto max-w-screen-sm text-center">
                                            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-600 "><i class="fa-regular fa-folder-open"></i></h1>
                                            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl ">Tidak ada pesanan</p>
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
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

        </div>
    </div>
</body>
<script src="../assets/js/main.js"></script>
<script>
if (document.getElementById("table_daftar_pesanan") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#table_daftar_pesanan", {
        searchable: false,
        perPageSelect: false
    });
}
</script>
</html>