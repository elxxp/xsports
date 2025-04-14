<?php
session_start();

$autofill_nama = @$_SESSION['s_nama'];
$autofill_telp = @$_SESSION['s_telp'];
$autofill_email = @$_SESSION['s_email'];

$tanggal = @$_POST['tanggal'];
$selectedJamMulai = @$_POST['jam_mulai'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Booking vanue</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php $current_page = "book"; require '../_partials/navbar.php'; ?> 

    <div class="mt-20 flex justify-center items-center h-fit">
        <div class="inner-container">
            <h5 class="my-10 font-bold text-center text-3xl text-gray-900 dark:text-white">Booking venue</h5>
            <form method="post">
                <ol class="relative border-s border-gray-200 dark:border-gray-700">
                    <!-- #pilih venue -->
                    <li id="s_venue" class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-tennis-ball text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Pilih venue</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Silakan pilih jenis olahraga dan lapangan yang diinginkan untuk kegiatan.</desc>

                        <div class="form mt-7">
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis olahraga</label>
                                <select name="sport" id="sport" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" onchange="orderGrand()">
                                    <option value="null">Pilih jenis olahraga</option>
                                    <option value="sepakbola" <?php if(@$_GET['autofill_sport'] == 'sepakbola'){echo 'selected';} ?> >Sepak bola</option>
                                    <option value="futsal" <?php if(@$_GET['autofill_sport'] == 'futsal'){echo 'selected';} ?> >Futsal</option>
                                    <option value="voli" <?php if(@$_GET['autofill_sport'] == 'voli'){echo 'selected';} ?> >Voli</option>
                                    <option value="tennis" <?php if(@$_GET['autofill_sport'] == 'tennis'){echo 'selected';} ?> >Tennnis</option>
                                    <option value="badminton" <?php if(@$_GET['autofill_sport'] == 'badminton'){echo 'selected';} ?> >Badminton</option>
                                    <option value="golf" <?php if(@$_GET['autofill_sport'] == 'golf'){echo 'selected';} ?> >Golf</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lapangan</label>
                                <select name="venue" id="venue" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:cursor-not-allowed disabled:text-gray-400" disabled onchange="orderGrand()">
                                    <option value="null">Pilih lapangan</option>
                                </select>
                            </div>

                            <!-- card informasi lapangan -->
                            <div class="block w-full p-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                                <p><span class="text-gray-700 text-sm dark:text-gray-300">Tarif lapangan</span> <span class="text-emerald-600 text-md font-bold dark:text-emerald-500">Rp. <span id="tarif">500,000</span></span> <span class="text-gray-700 text-sm dark:text-gray-300">/ jam</span></p>
                            </div>
                        </div>
                    </li>

                    <!-- #atur jadwal sewa -->
                    <li id="s_jadwal" class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-clock text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Atur jadwal sewa</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Tentukan waktu terbaik untuk bermain bersama teman atau komunitasmu.</desc>

                        <div class="form grid gap-2 w-sm mt-7">
                            <!-- alert ketersediaan jadwal -->
                            <div id="alertCekJadwal">

                            </div>

                            <!-- pilih tanggal -->
                            <div class="relative max-w-sm">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fa-regular fa-calendars text-slate-800 dark:text-slate-100"></i>
                                </div>
                                <input id="datepicker-format" datepicker datepicker-format="yyyy-mm-dd" type="text" name="tanggal" value="<?= @$tanggal ?>" class="bg-gray-50 cursor-pointer border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-white dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal" autocomplete="off" onchange="orderGrand()"/>
                            </div>

                            <!-- pilih jam -->
                            <div class="flex items-center">
                                <select name="jam_mulai" id="jam_mulai" value="a" onchange="updateJamSelesai()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer">
                                    <option value="null">Jam mulai</option>
                                    <option value="07:00" <?php if(@$selectedJamMulai == "07:00"){echo "selected";} ?>>07:00</option>
                                    <option value="08:00" <?php if(@$selectedJamMulai == "08:00"){echo "selected";} ?>>08:00</option>
                                    <option value="09:00" <?php if(@$selectedJamMulai == "09:00"){echo "selected";} ?>>09:00</option>
                                    <option value="10:00" <?php if(@$selectedJamMulai == "10:00"){echo "selected";} ?>>10:00</option>
                                    <option value="11:00" <?php if(@$selectedJamMulai == "11:00"){echo "selected";} ?>>11:00</option>
                                    <option value="12:00" <?php if(@$selectedJamMulai == "12:00"){echo "selected";} ?>>12:00</option>
                                    <option value="13:00" <?php if(@$selectedJamMulai == "13:00"){echo "selected";} ?>>13:00</option>
                                    <option value="14:00" <?php if(@$selectedJamMulai == "14:00"){echo "selected";} ?>>14:00</option>
                                    <option value="15:00" <?php if(@$selectedJamMulai == "15:00"){echo "selected";} ?>>15:00</option>
                                    <option value="16:00" <?php if(@$selectedJamMulai == "16:00"){echo "selected";} ?>>16:00</option>
                                    <option value="17:00" <?php if(@$selectedJamMulai == "17:00"){echo "selected";} ?>>17:00</option>
                                    <option value="18:00" <?php if(@$selectedJamMulai == "18:00"){echo "selected";} ?>>18:00</option>
                                    <option value="19:00" <?php if(@$selectedJamMulai == "19:00"){echo "selected";} ?>>19:00</option>
                                    <option value="20:00" <?php if(@$selectedJamMulai == "20:00"){echo "selected";} ?>>20:00</option> 
                                </select>
                                <span class="px-2 dark:text-white">-</span>
                                <select name="jam_selesai" id="jam_selesai" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-30 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-pointer disabled:cursor-not-allowed disabled:text-gray-400" onchange="orderGrand()" disabled>
                                    <option value="null">Jam selesai</option>
                                </select>
                            </div>
                            <button type="button" id="buttonCekJadwal" class="text-white w-full mt-5 bg-blue-700 cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 disabled:opacity-40" onclick="cekJadwal()">Cek ketersediaan jadwal</button>
                        </div>
                    </li>

                    <!-- #informasi kontak -->
                    <li id="s_kontak" class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-circle-user text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Informasi kontak<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300 ms-2">Auto</span></h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Digunakan untuk keperluan komunikasi terkait informasi jadwal lapangan.</desc>

                        <div class="form mt-7">
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama lengkap</label>
                                <input type="text" name="nama" value="<?= $autofill_nama ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Budi" autocomplete="off"/>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telp</label>
                                <input type="number" name="telp" value="<?= $autofill_telp ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="081-XXX-XXX" autocomplete="off"/>
                            </div>
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" value="<?= $autofill_email ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="contoh@mail.com" autocomplete="off"/>
                            </div>
                        </div>
                    </li>

                    <!-- #pembayaran -->
                    <li id="s_payment" class="mb-10 ms-8">            
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <i class="fa-solid fa-bag-shopping text-xs text-slate-800 dark:text-slate-100"></i>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">Pembayaran</h3>
                        <desc class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Silakan lakukan pembayaran sesuai nominal yang tertera.</desc>

                        <div class="form mt-7">
                            <ul class="grid w-full gap-2 md:grid-cols-2">
                                <li>
                                    <input type="radio" id="toggle-bca" name="payment" value="bca" class="hidden peer" checked/>
                                    <label for="toggle-bca" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bca.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="toggle-bni" name="payment" value="bni" class="hidden peer"/>
                                    <label for="toggle-bni" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bni.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="toggle-mandiri" name="payment" value="mandiri" class="hidden peer"/>
                                    <label for="toggle-mandiri" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-mandiri.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" id="toggle-bri" name="payment" value="bri" class="hidden peer"/>
                                    <label for="toggle-bri" class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 dark:peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold"><img src="../assets/images/logo-bri.png" class="h-8 ms-3"></div>
                                        </div>
                                    </label>
                                </li>
                            </ul>

                            <!-- card total pemesanan -->
                            <div class="block max-w-md mt-2 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Bank BCA</h5>
                                <h2 class="text-md tracking-tight text-gray-900 dark:text-white">No. Rekening : <strong>002459322470651 XSPORTS ID</strong></h2>
                                <div id="detail">
                                    <p class="text-sm tracking-tight text-gray-900 dark:text-white"><span class="text-xl text-blue-600 font-bold">Lengkapi data formulir!</span></p>
                                </div>

                                <div class="my-7">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload bukti pembayaran</label>
                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" disabled>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">IMG, PNG, JPG or JPEG (MAX. 10MB).</p>
                                </div>

                                <p class="font-normal text-sm text-gray-700 dark:text-gray-400"><i class="fa-regular fa-circle-exclamation mr-2"></i>Verifikasi pembayaran paling lambat 1x24 jam</p>
                            </div>
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
                            <!-- <button type="button" onclick="submit()" class="text-white w-full mt-5 bg-blue-700 cursor-pointer hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat pesanan</button> -->
                        </div>
                    </li>
                </ol>
            </form>
        </div>
    </div>
</body>
<script src="../assets/js/main.js"></script>
<script>
const sportSelect = document.getElementById('sport');
const venueSelect = document.getElementById('venue');

getVenue();
sportSelect.addEventListener('change', () => {
    getVenue();
});

function getVenue(){
    const sport = sportSelect.value;
    venueSelect.innerHTML = '<option value="null">Pilih lapangan</option>';

    if (sport === 'null') {
        venueSelect.disabled = true;
        return;
    }

    // Ambil lapangan dari server via fetch
    fetch('../core/fetch/getVenues.php?sport=' + sport)
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id_venue;
                option.textContent = item.venue;
                venueSelect.appendChild(option);
            });
            venueSelect.disabled = false;
        })
        .catch(error => {
            console.error('Gagal ambil data lapangan:', error);
        });
}
</script>

</html>