<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
staffOnly();

$venue = new Venue();

$getOrders = $venue->getDataVenues();
?>
<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Daftar venue</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">
    <?php require '../_partials/sidebar_dashboard.php'; ?>

    <div id="alertContainer">
        <?php if(@$_COOKIE['openVenueSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Venue berhasil di buka kembali
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['openVenueFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['closeVenueSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Venue berhasil di tutup
            </div>
        <?php endif; ?>
        
        <?php if(@$_COOKIE['closeVenueFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['deleteVenueSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Venue berhasil di hapus
            </div>
        <?php endif; ?>
        
        <?php if(@$_COOKIE['deleteVenueFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>
        
        <?php if(@$_COOKIE['makeVenueSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Berhasil membuat venue baru
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['updateVenueSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 dark:bg-green-700/20 border border-green-300  dark:text-green-600 dark:border-green-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Berhasil memperbarui data venue
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
                        #ID venue
                    </span>
                </th>
                <th data-type="date" data-format="Month YYYY">
                    <span class="flex items-center">
                        nama venue
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        jenis olahraga
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        tarif venue
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        detail overview
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        status venue
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
                <?php $ordinal = 0; foreach($getOrders as $order): $ordinal++; $status = $order['status']; $bukti_tipe_file = "image/jpeg"; @$bukti_data = base64_encode($order['thumbnail']); ?>

                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">#<?= $order['id_venue'] ?></td>
                        <td><?= $order['venue'] ?></td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $order['sport'] ?></td>
                        <td class="font-bold text-gray-900 whitespace-nowrap dark:text-white">Rp. <?= number_format($order['tarif']) ?></td>
                        <td>
                            <button data-modal-target="cardOvModal<?= $ordinal ?>" data-modal-toggle="cardOvModal<?= $ordinal ?>" class="transition cursor-pointer w-full inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">View card</button>

                            <!-- card overview modal -->
                            <div id="cardOvModal<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden pt-20 overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
                                            <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                                                <h3 class="font-semibold pb-5">
                                                    Preview venue #<?= $order['id_venue'] ?>
                                                    <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                        <span class="font-semibold">Created :</span> <?= $order['waktu_buat'] ?>
                                                    </p>
                                                    <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                                    <span class="font-semibold">Updated :</span> <?= $order['waktu_update'] ?>
                                                    </p>
                                                </h3>
                                            </div>
                                            <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800 mb-6 md:mb-8">
                                                <dl>
                                                    <!-- card -->
                                                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 cursor-default">
                                                        <div>
                                                            <?php if($order['thumbnail'] == null): ?>
                                                                <img class="rounded-t-lg h-48 w-96 object-cover" width="600" height="450" src="https://fakeimg.pl/600x350?text=No+image&font=bebas"/>
                                                            <?php else: ?>
                                                                <img class="rounded-t-lg h-48 w-96 object-cover" src="data:image/jpeg;base64,<?= base64_encode($order['thumbnail']) ?>"/>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="p-5">
                                                            <div>
                                                                <h5 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?= $order['venue'] ?></h5>
                                                                <div class="flex items-center">
                                                                    <span class="flex items-center w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                                                        <i class="fa-solid fa-bowling-ball-pin text-[10px] mr-1.5"></i><?= ucfirst($order['sport']) ?>
                                                                    </span>
                                                                    <?php if($order['status'] == 'open'): ?>
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
                                                            <h5 class="mt-3 tracking-tight text-gray-900 dark:text-white"><span class="text-xl font-bold text-emerald-600 dark:text-emerald-500">Rp. <?= number_format($order['tarif']) ?></span> / jam</h5>
                                                            <p class="font-normal text-gray-700 dark:text-gray-400"><?= $order['description'] ?></p>
                                                            <div class="flex items-center gap-2 mt-5">
                                                                <?php if($order['status'] == 'open'): ?>
                                                                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 cursor-pointer">
                                                                        Booking sekarang
                                                                    </button>
                                                                <?php else: ?>
                                                                    <button class="text-white bg-blue-700 font-medium rounded-lg text-sm px-4 py-1.5 dark:bg-blue-600 opacity-40" disabled>
                                                                        Booking sekarang
                                                                    </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end card -->
                                                </dl>
                                            </div>

                                        <div>   
                                            <button type="button" data-modal-toggle="cardOvModal<?= $ordinal ?>" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600">
                                                Tutup
                                            </button>             
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?php if($status == 'open'): ?>
                                <dd class="inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Open order
                                </dd>
                            <?php elseif($status == 'closed'): ?>
                                <dd class="inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                    Close order
                                </dd>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($status == "open"): ?>
                                <button data-modal-target="confirmModalSet<?= $ordinal ?>" data-modal-toggle="confirmModalSet<?= $ordinal ?>" class="transition cursor-pointer w-25 inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Set close</button>

                                <!-- confirm modal -->
                                <div id="confirmModalSet<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="confirmModalSet<?= $ordinal ?>">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>

                                            <p class="mb-2 mt-1 font-semibold text-gray-500 dark:text-gray-300"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Tutup pesanan venue <span class="font-bold">#<?= $order['id_venue'] ?></span> ?</p>
                                            <p class="mb-5 ml-2 text-sm text-gray-500 dark:text-gray-300">Venue akan tidak dapat menerima pesanan booking selama status venue close order. Lanjutkan?</p>
                                            <div class="flex justify-end items-center space-x-2">
                                                <form action="../core/form/updStatusVenue" method="post">
                                                    <input type="hidden" name="venue_close" value="<?= $order['id_venue'] ?>">
                                                    <button data-modal-toggle="confirmModalSet<?= $ordinal ?>" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        kembali
                                                    </button>
                                                    <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        tutup venue
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php elseif($status == "closed"): ?>
                                <button data-modal-target="confirmModalSet<?= $ordinal ?>" data-modal-toggle="confirmModalSet<?= $ordinal ?>" class="transition cursor-pointer w-25 inline-flex justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Set open</button>

                                <!-- confirm modal -->
                                <div id="confirmModalSet<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="confirmModalSet<?= $ordinal ?>">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>

                                            <p class="mb-2 mt-1 font-semibold text-gray-500 dark:text-gray-300"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Buka pesanan venue <span class="font-bold">#<?= $order['id_venue'] ?></span> ?</p>
                                            <p class="mb-5 ml-2 text-sm text-gray-500 dark:text-gray-300">Venue akan dapat menerima pesanan booking selama status venue open order. Lanjutkan?</p>
                                            <div class="flex justify-end items-center space-x-2">
                                                <form action="../core/form/updStatusVenue" method="post">
                                                    <input type="hidden" name="venue_open" value="<?= $order['id_venue'] ?>">
                                                    <button data-modal-toggle="confirmModalSet<?= $ordinal ?>" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        kembali
                                                    </button>
                                                    <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                        buka venue
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <button data-modal-target="confirmModalDelete<?= $ordinal ?>" data-modal-toggle="confirmModalDelete<?= $ordinal ?>" class="transition w-full rounded-lg px-3 py-2 text-center text-sm font-medium text-white bg-red-600 hover:bg-red-700 dark:text-red-500 dark:hover:bg-red-600 dark:hover:text-white lg:w-auto"><i class="fa-regular fa-trash-can w-4"></i></button>
                            <!-- confirm modal -->
                            <div id="confirmModalDelete<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                        <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="confirmModalDelete<?= $ordinal ?>">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>

                                        <p class="mb-2 mt-1 font-semibold text-gray-500 dark:text-gray-300"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Hapus venue <span class="font-bold">#<?= $order['id_venue'] ?></span> ?</p>
                                        <p class="mb-5 ml-2 text-sm text-gray-500 dark:text-gray-300">Pesanan yang terkait dangan venue #<?= $order['id_venue'] ?> akan ikut terhapus dari daftar pesanan dan tidak dapat dikembalikan. Lanjutkan?</p>
                                        <div class="flex justify-end items-center space-x-2">
                                            <form action="../core/form/deleteVenue" method="post">
                                                <input type="hidden" name="venue_delete" value="<?= $order['id_venue'] ?>">
                                                <button data-modal-toggle="confirmModalDelete<?= $ordinal ?>" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                    kembali
                                                </button>
                                                <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                    hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button onclick="location.href='update_venue?id_venue=<?= $order['id_venue'] ?>'" class="transition cursor-pointer w-full rounded-lg bg-blue-700 px-3 py-2 text-sm font-medium text-white hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 lg:w-auto"><i class="fa-regular fa-pen w-4"></i></button>
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