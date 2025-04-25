<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
staffOnly();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if((!isset($_POST['venue']) || $_POST['venue'] != "") &&
    (!isset($_POST['sport']) || $_POST['sport'] != "" || $_POST['sport'] != "null") &&
    (!isset($_POST['tarif']) || ($_POST['tarif'] != "" && $_POST['tarif'] > 0)) &&
    (!isset($_POST['status']) || $_POST['status'] != "") &&
    (!isset($_POST['deskripsi']) || $_POST['deskripsi'] != "")){

        $nama_venue = $_POST['venue'];
        $jenis_olahraga = $_POST['sport'];
        $tarif = $_POST['tarif'];
        $status = $_POST['status'];
        $deskripsi = $_POST['deskripsi'];

        if($_FILES['thumbnail']['tmp_name'] != null){
            $thumbnail = addslashes(file_get_contents($_FILES['thumbnail']['tmp_name']));
        } else {
            $thumbnail = null;
        }

        $venue = new Venue();
        if($venue->makeVenue($nama_venue, $jenis_olahraga, $tarif, $status, $thumbnail, $deskripsi)){
            setcookie('makeVenueSuccess', 'ok', time() + 1, "/");
            header('location: daftar_venue');
        } else {
            $notif = 
            '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 /20 border border-red-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
            ';
        }

        
    } else {
        $notif = 
        '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 /20 border border-red-300    rounded-lg px-3.5 py-2 mb-1">
            <i class="fa-solid fa-circle-exclamation mr-2"></i>Pastikan data yang dimasukan lengkap dan valid
        </div>
        ';

    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Tambah venue</title>
</head>
<body class="bg-slate-100 ">
    <?php require '../_partials/sidebar_dashboard.php'; ?>
    <div id="alertContainer">
        <?= @$notif ?>
    </div>

    <!-- content -->
    <div class="p-4 sm:ml-64">
    <div class="p-4 rounded-xl bg-white mt-14 shadow-sm">

        <section>
            <div class="py-4 px-4 lg:py-8">
                <h2 class="mb-4 text-xl font-bold text-gray-900 ">Tambah venue baru</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Nama venue</label>
                            <input type="text" name="venue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="Masukan nama venue" autocomplete="off">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Jenis olahraga</label>
                            <select name="sport" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     :ring-blue-500 :border-blue-500">
                                <option value="null">Pilih jenis olahraga</option>
                                <option value="sepakbola">Sepakbola</option>
                                <option value="futsal">Futsal</option>
                                <option value="voli">Voli</option>
                                <option value="tennis">Tennis</option>
                                <option value="badminton">Badminton</option>
                                <option value="golf">Golf</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Harga tarif / jam</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    Rp.
                                </div>
                                <input type="number" name="tarif" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5      :ring-blue-500 :border-blue-500" placeholder="100000" autocomplete="off">
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Status venue</label>
                            <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     :ring-blue-500 :border-blue-500">
                                <option value="open">Open</option>
                                <option value="closed">Close</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Thumbnail venue (opsional)</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none   " name="thumbnail" type="file" accept="image/png, image/jpeg, image/jpg">
                        </div> 
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900 ">Deskripsi venue</label>
                            <textarea name="deskripsi" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500     :ring-blue-500 :border-blue-500" placeholder="Masukan deskripsi venue disini" autocomplete="off"></textarea>
                        </div>
                    </div>
                    <button data-modal-target="confirmModal" data-modal-toggle="confirmModal" type="button" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 :ring-blue-900 hover:bg-blue-800">
                        Tambah venue
                    </button>

                    <!-- confirm modal -->
                    <div id="confirmModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
                                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :bg-gray-600 :text-white" data-modal-toggle="confirmModal">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <p class="mb-2 mt-1 font-semibold text-gray-500 "><i class="fa-regular fa-triangle-exclamation mx-2"></i>Tambahkan venue?</p>
                                <p class="mb-5 ml-2 text-sm text-gray-500 ">Pastikan seluruh data venue telah sesuai dan valid.</p>
                                <div class="flex justify-end items-center space-x-2">
                                    <form action="../core/form/deleteOrder" method="post">
                                        <input type="hidden" name="order" value="0">
                                        <button data-modal-toggle="confirmModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10    :text-white :bg-gray-600 :ring-gray-600">
                                            kembali
                                        </button>
                                        <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 :ring-blue-900 hover:bg-blue-800">
                                            tambah
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </section>

    </div>
    </div>
</body>
<script src="../assets/js/main.js"></script>
</html>