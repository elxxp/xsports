<?php
session_start();
require '../core/app.php';
require '../core/functions.php';
staffOnly();

$account = new Account();

$getUsers = $account->getDataUsers($_SESSION['s_id']);
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
        <?php if(@$_COOKIE['deleteSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 /20 border border-green-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Akun berhasil dihapus
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['deleteFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 /20 border border-red-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['updateSuccess']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-green-600 bg-green-400/20 /20 border border-green-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-check mr-2"></i>Level akun berhasil dimodifikasi
            </div>
        <?php endif; ?>

        <?php if(@$_COOKIE['updateFail']): ?>
            <div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-20 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 /20 border border-red-300    rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Terjadi kesalahan, coba lagi
            </div>
        <?php endif; ?>
    </div>

    <!-- content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-xl bg-white mt-14 shadow-sm">

        <table id="table_daftar_akun" class="text-xs">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            #ID user
                        </span>
                    </th>
                    <th data-type="date" data-format="Month YYYY">
                        <span class="flex items-center">
                            nama lengkap
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            email
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            nomor telepon
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            akun terdaftar
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            level
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if($getUsers->num_rows > 0): ?>
                    <?php $ordinal = 0; foreach($getUsers as $user): $ordinal++; ?>

                        <tr>
                            <td class="font-medium text-gray-900 whitespace-nowrap ">#<?= $user['id_user'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['telephone'] ?></td>
                            <td><?= $user['waktu_daftar'] ?></td>
                            <td>
                                <form action="../core/form/updLevelUser" method="post">
                                    <input type="hidden" name="user" value="<?= $user['id_user'] ?>">
                                    <select onchange="this.form.submit()" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5     :ring-blue-500 :border-blue-500">
                                        <option <?= ($user['level'] == 'guest') ? 'selected' : '' ?> value="guest">Guest</option>
                                        <option <?= ($user['level'] == 'admin') ? 'selected' : '' ?> value="admin">Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <button data-modal-target="confirmModalDelete<?= $ordinal ?>" data-modal-toggle="confirmModalDelete<?= $ordinal ?>" class="transition w-full rounded-lg px-3 py-2 text-center text-sm font-medium text-white bg-red-600 hover:bg-red-700  :bg-red-600 :text-white lg:w-auto"><i class="fa-regular fa-trash-can w-4"></i></button>
                            
                                <!-- confirm modal -->
                                <div id="confirmModalDelete<?= $ordinal ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative p-4 bg-white rounded-lg shadow  sm:p-5">
                                            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :bg-gray-600 :text-white" data-modal-toggle="confirmModalDelete<?= $ordinal ?>">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>

                                            <p class="mb-2 mt-1 font-semibold text-gray-500 "><i class="fa-regular fa-triangle-exclamation mx-2"></i>Hapus akun <span class="font-bold">#<?= $user['id_user'] ?></span> ?</p>
                                            <p class="mb-5 ml-2 text-sm text-gray-500 ">Akun yang dihapus tidak dapat dikembalikan kembali, dan data seluruh pesanan yang terkait dengan akun #<?= $user['id_user'] ?> juga akan terhapus. Yakin menghapus?</p>
                                            <div class="flex justify-end items-center space-x-2">
                                                <form action="../core/form/deleteAccount" method="post">
                                                    <input type="hidden" name="account" value="<?= $user['id_user'] ?>">
                                                    <button data-modal-toggle="confirmModalDelete<?= $ordinal ?>" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10    :text-white :bg-gray-600 :ring-gray-600">
                                                        kembali
                                                    </button>
                                                    <button class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300  :bg-red-600 :ring-red-900">
                                                        hapus akun
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan=7>
                            <section>
                                <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                                    <div class="mx-auto max-w-screen-sm text-center">
                                        <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-blue-600 "><i class="fa-regular fa-user-secret"></i></h1>
                                        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl ">Tidak ada pengguna selain anda</p>
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
                    </tr>
                <?php endif; ?>
            </tbody>
            </table>
    </div>
    
</body>
<script src="../assets/js/main.js"></script>
<script>
if (document.getElementById("table_daftar_akun") && typeof simpleDatatables.DataTable !== 'undefined') {
    const dataTable = new simpleDatatables.DataTable("#table_daftar_akun", {
        paging: true,
        perPage: 10,
        perPageSelect: [10, 15, 20, 25],
        sortable: false
    });
}
</script>
</html>