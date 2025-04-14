<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/header.html'; ?>
    <title>Document</title>
</head>
<body class="bg-slate-900 text-white">


    <div class="container mt-150 flex justify-center items-center h-screen">
        <div class="inner-container">
            <form method="post">
                <ol class="relative border-s border-gray-200">     
                    <!-- Pilih venue -->
                    <li class="mb-10 ms-10">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                            <i class="fa-solid fa-tennis-ball text-xs text-slate-800"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-white">Pilih venue<span class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm ms-3">Auto</span></h3>
                        <p class="mb-4 text-base font-normal text-gray-500">Silakan pilih jenis olahraga dan lapangan yang diinginkan untuk kegiatan.</p>
                        
                        <div class="w-sm grid gap-2">
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-medium text-white">Jenis olahraga</label>
                                <select class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected>Pilih jenis olahraga</option>
                                    <option value="sepakbola">Sepak bola</option>
                                    <option value="futsal">Futsal</option>
                                    <option value="basket">Basket</option>
                                    <option value="Tennis">Tennnis</option>
                                    <option value="badminton">Badminton</option>
                                    <option value="golf">Golf</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-medium text-white">Lapangan</label>
                                <select class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 disabled:bg-gray-900 disabled:text-gray-400" disabled>
                                    <option selected>Pilih lapangan</option>
                                    
                                </select>
                            </div>
                        </div>
    
      
                    </li>

                    <!-- Atur jadwal main -->
                    <li class="mb-10 ms-10">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                            <i class="fa-solid fa-calendar-week text-xs text-slate-800"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-white">Atur jadwal main</h3>
                        <p class="mb-4 text-base font-normal text-gray-500">Tentukan waktu terbaik untuk bermain bersama teman atau komunitasmu.</p>
                        
                        <div class="w-sm grid gap-2">
                            <!-- date pick -->
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fa-regular fa-calendar text-white"></i>
                                </div>
                                <input id="datepicker-autohide" datepicker datepicker-autohide type="text" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 placeholder-white " placeholder="Atur tanggal">
                            </div>
                            
                            <div class="flex items-center">
                                <div>
                                    <select id="jam_mulai" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 p-2.5" onchange="updateJamSelesai()">
                                        <option selected>Jam mulai</option>
                                        <?php
                                        for ($i = 7; $i <= 20; $i++) {
                                            $jam_view = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
                                            $jam_values = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00:00";
                                            echo "<option value=\"$jam_values\">$jam_view</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <span class="px-2">:</span>
                                <div>
                                    <select id="jam_selesai" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-40 p-2.5 disabled:bg-gray-900 disabled:text-gray-400" disabled>
                                        <option selected>Jam selesai</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="mt-5 text-white cursor-pointer bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 w-full">Cek ketersediaan jadwal</button>
                        </div>
    
                        
                    </li>

                    <!-- Informasi kontak -->
                    <li class="mb-10 ms-10">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                            <i class="fa-solid fa-user-tie text-xs text-slate-800"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-white">Informasi kontak</h3>
                        <p class="mb-4 text-base font-normal text-gray-500">Digunakan untuk keperluan komunikasi terkait informasi jadwal lapangan.</p>
    
                        <div class="w-sm grid gap-2">
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-medium text-white">Nama</label>
                                <input type="text" class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan nama penyewa"/>
                            </div>
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-medium text-white">No. Telp</label>
                                <input type="number" class="appearance-none bg-gray-50 border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="081-XXX-XXX"/>
                            </div>
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-medium text-white">Email</label>
                                <input type="text" class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" placeholder="Masukan email penyewa (optional)"/>
                            </div>
                        </div>
    
      
                    </li>

                    <!-- Pembayaran -->
                    <li class="mb-10 ms-10">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                            <i class="fa-solid fa-bag-shopping text-xs text-slate-800"></i>
                        </span>
                        <h3 class="mb-1 text-lg font-semibold text-white">Pembayaran</h3>
                        <p class="text-base font-normal text-gray-500">Sihlakan memilih beberapa metode pembayaran yang tersedia.</p>
    
                        <div class="mt-5">


                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-white">Virtual account (transfer bank)</label>
                            <ul class="grid w-full gap-2 md:grid-cols-2">
                                <li>
                                    <input type="radio" id="bca" name="hosting" value="payment-bca" class="hidden peer" required />
                                    <label for="bca" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block ms-3">
                                            <div class="w-full text-lg font-semibold">BCA</div>
                                            <!-- <div class="w-full">Bank BCA</div> -->
                                            <!-- <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bca.png" class="h-8"></div> -->
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="bni" name="hosting" value="payment-bni" class="hidden peer" required />
                                    <label for="bni" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bni.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="bri" name="hosting" value="payment-bri" class="hidden peer" required />
                                    <label for="bri" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bri.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="mandiri" name="hosting" value="payment-mandiri" class="hidden peer" required />
                                    <label for="mandiri" class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-mandiri.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>

                            </ul>
                        </div>



    
                        </div>
                    </li>

                    <!-- Syarat dan ketentuan -->
                    <li class="mb-10 ms-10">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                            <i class="fa-solid fa-file-contract text-xs text-slate-800"></i>
                        </span>
                        <h3 class="mb-1 text-lg font-semibold text-white">Syarat dan ketentuan</h3>
                        <p class="text-base font-normal text-gray-500">Harap menyetujui seluruh persyaratan dan ketentuan yang berlaku untuk kenyamanan bersama</p>
    
                        <div class="mt-5">
                            <div class="flex items-center mb-1">
                                <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-300">Saya menyetujui <a href="#" class="text-blue-600 hover:underline">syarat dan ketentuan</a> yang berlaku saat ini.</label>
                            </div>
                            <div class="flex items-center mb-1">
                                <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                <label for="link-checkbox" class="ms-2 text-sm font-medium text-gray-300">Saya memahami bahwa pembayaran bersifat <strong>non-refundable</strong> jika batal sepihak.</label>
                            </div>
    
                        </div>
                    </li>

                    <!-- Konfirmasi -->
                    <li class="mb-10 ms-10">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white">
                            <i class="fa-solid fa-circle-check text-xs text-slate-800"></i>
                        </span>
                        <h3 class="mb-1 text-lg font-semibold text-white">Konfirmasi</h3>
                        <p class="text-base font-normal text-gray-500">Mohon pastikan seluruh informasi yang Anda berikan sudah benar.</p>
                        
                        <button class="mt-5 text-white cursor-pointer bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 w-full">Buat pesanan</button>
    
                    </li>
                </ol>
            </form>
        </div>
    </div>

    
</body>
<script src="../assets/js/main.js"></script>
</html>