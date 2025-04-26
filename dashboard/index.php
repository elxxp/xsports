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
        </div>


    
    </div>
    </div>
</body>
<script src="../assets/js/main.js"></script>
</html>