<?php
session_start();
require '../core/App.php';
require '../core/functions.php';
levelFilter();

$sport = (!isset($_GET['sport_filter'])) ? 'all' : $_GET['sport_filter'];
$venue = new Venue();
$venues = $venue->getDataVenues($sport);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Lapangan</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php $current_page = "venues"; require '../_partials/navbar.php'; ?>

    <section class="pt-20">
        <div class="px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
            <h1 class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Temukan lapangan yang terbaik</h1>
        </div>
    </section>

    <section class="py-8 antialiased md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-center space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <button <?= ($sport != 'all') ? 'onclick=location.href="venues" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Semua</button>
                <!-- <span class="px-4"></span> -->
                <button <?= ($sport != 'sepakbola') ? 'onclick=location.href="venues?sport_filter=sepakbola" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Sepak bola</button>
                <button <?= ($sport != 'futsal') ? 'onclick=location.href="venues?sport_filter=futsal" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Futsal</button>
                <button <?= ($sport != 'voli') ? 'onclick=location.href="venues?sport_filter=voli" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Voli</button>
                <button <?= ($sport != 'tennis') ? 'onclick=location.href="venues?sport_filter=tennis" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Tennis</button>
                <button <?= ($sport != 'badminton') ? 'onclick=location.href="venues?sport_filter=badminton" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Badminton</button>
                <button <?= ($sport != 'golf') ? 'onclick=location.href="venues?sport_filter=golf" class="cursor-pointer text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"' : 'class="text-gray-900 border border-gray-300 focus:outline-none bg-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-gray-600 dark:bg-gray-700 dark:hover:border-gray-600"' ?>>Golf</button>
            </div>

            <!-- content -->
            <div class="mb-4 grid justify-items-center gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3  xl:grid-cols-4">
                <?php if($venues->num_rows > 0): ?>
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
                <?php else: ?>
                    <section class="sm:col-span-2 md:mb-8 lg:col-span-3  xl:col-span-4">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                            <div class="mx-auto max-w-screen-sm text-center">
                                <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-600 dark:text-blue-500"><i class="fa-regular fa-basketball-hoop"></i></h1>
                                <p class="mb-1 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">Venue tidak tersedia</p>
                                <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Pastikan metode filter telah valid dan sesuai</p>
                            </div>   
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </section>

</body>
<?php require '../_partials/footer.html'; ?>
</html>


