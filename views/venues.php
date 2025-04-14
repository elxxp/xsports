<?php
session_start();
require '../core/App.php';

$db = new Database();
$conn = $db->get();


$venues = $conn->query("SELECT * FROM venues ORDER BY venue ASC");

// while ($row = $result->fetch_assoc()) {
//     echo $row['venue'] . "<br>";
// }

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
        <div class="py-4 px-4 mx-auto max-w-screen-xl text-center lg:py-8 lg:px-12">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Temukan lapangan yang cocok untuk mu</h1>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
                <!-- <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Learn more
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
                <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                    Watch video
                </a>   -->
            </div>
        </div>
    </section>

    <section class="py-8 antialiased md:py-12">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <!-- Heading & Filters -->
        <div class="mb-4 items-end justify-center space-y-4 sm:flex sm:space-y-0 md:mb-8">

        </div>

        <!-- content -->
        <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            <?php foreach($venues as $venue): ?>
                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 cursor-default">
                        <a href="#">
                            <?php if($venue['thumbnail'] == null): ?>
                                <img class="rounded-t-lg h-48 w-96 object-cover" width="600" height="450" src="https://fakeimg.pl/600x350?text=No+image&font=bebas"/>
                            <?php else: ?>
                                <img class="rounded-t-lg h-48 w-96 object-cover" src="data:image/jpeg;base64,<?= base64_encode($venue['thumbnail']) ?>"/>
                            <?php endif; ?>
                        </a>
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
        <div class="w-full text-center">
        <button type="button" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Show more</button>
        </div>
    </div>

    </section>

</body>
<script src="../assets/js/main.js"></script>
</html>


