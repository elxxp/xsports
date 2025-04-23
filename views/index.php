<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
levelFilter();

$db = new Database();
$venues = $db->query("SELECT * FROM venues WHERE status = 'open' ORDER BY RAND() LIMIT 3");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>XSPORTS INDONESIA</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php $current_page = "home"; require '../_partials/navbar.php'; ?>

    <section class="bg-bottom bg-no-repeat bg-[url(../assets/images/banner.jpg)] bg-gray-700 bg-blend-multiply h-screen">
        <div class="pt-[15%] px-4 mx-auto max-w-screen-xl text-center">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Game On <span class="text-blue-600">Anytime</span></h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Memberi kebebasan penuh untuk memilih waktu penyewaan lapangan sesuai kebutuhanmu. Dengan jadwal yang fleksibel dan sistem booking yang mudah, kamu tinggal pilih waktu, pesan venue, dan langsung gas main!</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="book" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Booking sekarang
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
                <a href="venues" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    Lihat lapangan
                </a>  
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">We didn't reinvent the wheel</h2>
                <p class="mb-4">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.</p>
                <p>We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg w-[280px] h-[390px] object-cover" src="../assets/images/people-basket.jpg">
                <img class="mt-4 w-full lg:mt-10 rounded-lg w-[280px] h-[390px] object-cover" src="../assets/images/person-shuttlecock.jpg">
            </div>
        </div>
    </section>

    <section class="py-20 antialiased md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-start ml-4 space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <p class="text-2xl font-bold">Rekomendasi venue</p>
            </div>

            <!-- content -->
            <div class="mb-4 grid justify-items-center sm:grid-cols-2 md:mb-8 lg:grid-cols-3 gap-4 xl:grid-cols-4">
                <?php foreach($venues as $venue): ?>
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 cursor-default">
                            <div>
                                <?php if($venue['thumbnail'] == null): ?>
                                    <img class="rounded-t-lg h-48 w-96 object-cover" width="600" height="450" src="https://fakeimg.pl/600x350?text=No+image&font=bebas"/>
                                <?php else: ?>
                                    <img class="rounded-t-lg h-48 w-96 object-cover" src="data:image/jpeg;base64,<?= base64_encode($venue['thumbnail']) ?>"/>
                                <?php endif; ?>
                            </div>
                            <div class="p-5">
                                <div>
                                    <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $venue['venue'] ?></h5>
                                    <div class="flex items-center">
                                        <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                            <i class="fa-solid fa-bowling-ball-pin text-[10px] mr-1.5"></i><?= ucfirst($venue['sport']) ?>
                                        </span>
                                        <?php if($venue['status'] == 'open'): ?>
                                            <span class="flex items-center w-fit bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                                Open
                                            </span>
                                        <?php else: ?>
                                            <span class="flex items-center w-fit bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                                Close
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <h5 class="mt-3 tracking-tight text-gray-900 dark:text-white"><span class="text-xl font-bold text-emerald-600 dark:text-emerald-500">Rp. <?= number_format($venue['tarif']) ?></span> / jam</h5>
                                <p class="font-normal text-gray-700 dark:text-gray-400"><?= $venue['description'] ?></p>
                                <div class="flex items-center gap-2 mt-5">
                                    <?php if($venue['status'] == 'open'): ?>
                                        <a href="book?autofill_sport=<?= $venue['sport'] ?>&autofill_venue=<?= $venue['id_venue'] ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 cursor-pointer">
                                            Booking sekarang
                                        </a>
                                    <?php else: ?>
                                        <button class="text-white bg-blue-700 font-medium rounded-lg text-sm px-4 py-1.5 dark:bg-blue-600 opacity-40" disabled>
                                            Booking sekarang
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                
                    <?php endforeach; ?>

            </div>
        </div>
    </section>



</body>
<?php require '../_partials/footer.html'; ?>
</html>

