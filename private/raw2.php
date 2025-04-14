<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/header.html'; ?>
    <title>Document</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">


    <div class="container mt-150 flex justify-center items-center h-screen">
        <div class="inner-container">
            <form method="post">
                <ol class="relative border-s border-gray-200 dark:border-gray-700">
                    <!-- #pilih venue -->
                    <li class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-tennis-ball text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Pilih venue</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Silakan pilih jenis olahraga dan lapangan yang diinginkan untuk kegiatan.</desc>

                        <div class="form mt-7">
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis olahraga</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih jenis olahraga</option>
                                    <option value="sepakbola">Sepak bola</option>
                                    <option value="futsal">Futsal</option>
                                    <option value="basket">Basket</option>
                                    <option value="Tennis">Tennnis</option>
                                    <option value="badminton">Badminton</option>
                                    <option value="golf">Golf</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapangan</label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih lapangan</option>
                                </select>
                            </div>

                            <!-- card informasi lapangan -->
                            <div href="#" class="block w-full p-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                                <p><span class="text-gray-700 text-sm dark:text-gray-300">Tarif lapangan</span> <span class="text-emerald-600 text-md font-bold dark:text-emerald-500">Rp, 2.000.000</span> <span class="text-gray-700 text-sm dark:text-gray-300">/ jam</span></p>
                            </div>
                        </div>
                    </li>

                    <!-- #atur jadwal sewa -->
                    <li class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-clock text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Atur jadwal sewa</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Tentukan waktu terbaik untuk bermain bersama teman atau komunitasmu.</desc>

                        <div class="form grid gap-2 w-sm mt-7">
                            <!-- alert ketersediaan jadwal -->
                            <div class="flex items-center p-3 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                                <i class="fa-regular fa-circle-check mr-2"></i>
                                <div>
                                    <span class="font-medium">Yeay, jadwal yang kamu pilih tersedia!</span>
                                </div>
                            </div>
                            <div class="flex items-center p-3 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                                <i class="fa-regular fa-circle-xmark mr-2"></i>
                                <div>
                                    <span class="font-medium">Yah, jadwal sudah di booking. Coba jadwal lain</span>
                                </div>
                            </div>
                            <div class="flex items-center p-3 text-sm text-orange-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-orange-300 dark:border-yellow-800" role="alert">
                                <i class="fa-regular fa-circle-exclamation mr-2"></i>
                                <div>
                                    <span class="font-medium">Atur jadwal terlebih dahulu</span>
                                </div>
                            </div>

                            <!-- pilih tanggal -->
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fa-regular fa-calendars text-slate-800 dark:text-slate-100"></i>
                                </div>
                                <input id="datepicker-autohide" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-white dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal">
                            </div>

                            <!-- pilih jam -->
                            <div class="flex items-center">
                                <select id="jam_mulai" onchange="updateJamSelesai()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
                                    <option selected>Jam mulai</option>
                                    <?php
                                        for ($i = 7; $i <= 20; $i++) {
                                            $jam_view = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
                                            $jam_values = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00:00";
                                            echo "<option value=\"$jam_values\">$jam_view</option>";
                                        }
                                    ?>
                                </select>
                                <span class="px-2 dark:text-white">-</span>
                                <select id="jam_selesai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer disabled:cursor-not-allowed disabled:text-gray-400" disabled>
                                    <option selected>Jam selesai</option>
                                </select>
                            </div>
                            <button type="button" class="text-white w-full mt-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cek ketersediaan jadwal</button>
                        </div>
                    </li>

                    <!-- #informasi kontak -->
                    <li class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-circle-user text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Informasi kontak<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-2">Auto</span></h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Digunakan untuk keperluan komunikasi terkait informasi jadwal lapangan.</desc>

                        <div class="form mt-7">
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama lengkap</label>
                                <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Budi" autocomplete="off"/>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telp</label>
                                <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="081-XXX-XXX" autocomplete="off"/>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="contoh@mail.com" autocomplete="off"/>
                            </div>
                        </div>
                    </li>

                    <!-- #pembayaran -->
                    <li class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-bag-shopping text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Pembayaran</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Silakan lakukan pembayaran dan ikuti instruksi.</desc>

                        <div class="form mt-7">
                            <ul class="grid w-full gap-2 md:grid-cols-2">
                                <li>
                                    <input type="radio" id="toggle-bca" name="payment" value="bca" class="hidden peer" />
                                    <label for="toggle-bca" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bca.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="toggle-bni" name="payment" value="bni" class="hidden peer" />
                                    <label for="toggle-bni" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bni.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="toggle-mandiri" name="payment" value="mandiri" class="hidden peer" />
                                    <label for="toggle-mandiri" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-mandiri.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="toggle-bri" name="payment" value="bri" class="hidden peer" />
                                    <label for="toggle-bri" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bri.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- #konfirmasi -->
                    <li class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-circle-check text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Konfirmasi pesanan</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Mohon pastikan seluruh informasi yang Anda berikan sudah benar.</desc>

                        <div class="form mt-7">
                            <div class="flex">
                                <div class="flex items-center h-5">
                                    <input id="helper-checkbox" aria-describedby="helper-checkbox-text" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div class="ms-2 text-sm">
                                    <label for="helper-checkbox" class="font-medium text-gray-900 dark:text-gray-300">Saya menyetujui <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-blue-600 hover:underline">syarat dan ketentuan</button> yang berlaku saat ini.</label>
                                    <p id="helper-checkbox-text" class="text-xs font-normal text-gray-500 dark:text-gray-300">serta memahami bahwa pembayaran bersifat <strong>non-refundable</strong> jika batal sepihak.</p>
                                </div>
                            </div>
                            <button name="book" class="text-white w-full mt-5 bg-blue-700 cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat pesanan</button>
                        </div>
                    </li>
                </ol>
            </form>
        </div>
    </div>

    
</body>
<script src="../assets/js/main.js"></script>
</html>