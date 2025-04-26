<?php
if(isset($_SESSION['s_id']) && isset($_SESSION['s_nama']) && isset($_SESSION['s_telp']) && isset($_SESSION['s_email']) && isset($_SESSION['level'])) { 
    $account = new Account(); $user = $account->getDataUser($_SESSION['s_id']);

    $_SESSION['s_nama'] = $user['name'];
    $_SESSION['s_telp'] = $user['telephone'];
    $_SESSION['s_email'] = $user['email'];
    $_SESSION['level'] = $user['level'];
?>

<header>
    <nav class="fixed w-screen shadow-md bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 z-100 top-0">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="../views" class="flex items-center">
                <img src="../assets/images/logo.png" class="h-8 sm:h-9" alt="Flowbite Logo"/>
                <span class="ml-3 self-center text-xl font-semibold hidden whitespace-nowrap dark:text-white">XSPORTS</span>
            </a>
            <div class="flex items-center lg:order-2">

                <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm bg-gray-800 rounded-full md:me-0 cursor-pointer focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" type="button">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="../assets/images/pfp-placeholder.jpg" alt="user photo">
                </button>

                <!-- Dropdown profile menu -->
                <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div><?= $_SESSION['s_nama'] ?></div>
                    <div class="font-medium truncate"><?= $_SESSION['s_email'] ?></div>
                    </div>
                    <div class="py-2">
                    <a data-modal-target="overviewProfileModal" data-modal-toggle="overviewProfileModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
                    </div>
                </div>

                <a href="orders" class="text-white ml-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cek Pesanan</a>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="../views" class="<?php if(@$current_page == 'home'){echo "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white";}else{echo "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700";} ?>">Home</a>
                    </li>
                    <li>
                        <a href="venues" class="<?php if(@$current_page == 'venues'){echo "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white";}else{echo "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700";} ?>">Venue</a>
                    </li>
                    <li>
                        <a href="book" class="<?php if(@$current_page == 'book'){echo "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white";}else{echo "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700";} ?>">Booking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- profile overview modal -->
<div id="overviewProfileModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6">
            <div class="mb-4 rounded-t sm:mb-5">
                <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                    <h3 class="font-semibold">
                        Profile Overview
                        <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            USER ID #<?= $user['id_user'] ?>
                        </p>
                    </h3>
                </div>
            </div>
            <dl>
                <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-800 mb-4 md:mb-6">
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Nama lengkap</dt>
                        <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $user['name'] ?></dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Email</dt>
                        <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $user['email'] ?></dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">No. Telp</dt>
                        <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= $user['telephone'] ?></dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Password</dt>
                        <dd data-modal-target="updatePasswordModal" data-modal-toggle="updatePasswordModal" onclick="closeOverview()" class="cursor-pointer underline font-medium text-blue-900 dark:text-blue-400 sm:text-end">Ubah password</dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 dark:text-gray-400">Akun tedaftar</dt>
                        <dd class="font-medium text-gray-900 dark:text-white sm:text-end"><?= tanggalClean($user['waktu_daftar']) ?></dd>
                    </dl>
                </div>
            </dl>

            <div>
                <button data-modal-target="updateProfileModal" data-modal-toggle="updateProfileModal" onclick="closeOverview()" class="cursor-pointer w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Edit profile
                </button>        
                <button id="btnCloseOverview" data-modal-toggle="overviewProfileModal" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Tutup
                </button>             
            </div>
        </div>
    </div>
</div>

<!-- edit profile modal -->
<div id="updateProfileModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                <h3 class="font-semibold">
                    Update profile
                    <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            USER ID#<?= $user['id_user'] ?>
                        </p>
                </h3>
                <button type="button" id="btnCloseEditPro" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateProfileModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="formEditProfile" action="../core/form/updProfile" method="post">
                <div class="grid gap-4 mb-4 sm:grid-cols-2 pt-5">
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama lengkap</label>
                        <input type="text" name="name" id="controlEditName" value="<?= $user['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<?= $user['name'] ?>" autocomplete="off">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat email</label>
                        <input type="text" name="email" id="controlEditEmail" value="<?= $user['email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<?= $user['email'] ?>" autocomplete="off">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Telp</label>
                        <input type="text" name="phone" id="controlEditPhone" value="<?= $user['telephone'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<?= $user['telephone'] ?>" autocomplete="off">
                    </div>
    
                    <div id="notifEditProfileModalContainer" class="col-span-2">
    
                    </div>
                </div>
            </form>
            <div class="flex items-center space-x-4">
                <button data-modal-target="overviewProfileModal" data-modal-toggle="overviewProfileModal" type="button" onclick="closeEditPro()" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Kembali
                </button>
                <button type="button" id="btnSubmitEditProfile" onclick="EditProfile()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-40">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- edit password modal -->
<div id="updatePasswordModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <div class="relative p-5 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <div class="flex items-center text-lg text-gray-900 md:text-xl dark:text-white">
                <h3 class="font-semibold">
                    Update password
                    <p class="text-xs font-normal text-gray-500 dark:text-gray-400">
                            USER ID#<?= $user['id_user'] ?>
                        </p>
                </h3>
                <button type="button" id="btnCloseEditPass" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updatePasswordModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-1 pt-5">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password lama</label>
                    <input type="password" name="passOld" id="controlEditPassOld" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan password sebelumnya" autocomplete="off">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buat password baru (min. 8)</label>
                    <input type="password" name="passCurr" id="controlEditPassCurr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buat password" autocomplete="off">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi password</label>
                    <input type="password" id="controlEditPassConfirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan ulang password" autocomplete="off">

                    <div class="flex items-center justify-between mt-2 ml-1">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="show" aria-describedby="show" type="checkbox" onclick="showEditPassword('controlEditPassOld', 'controlEditPassCurr')" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="show" class="text-gray-500 dark:text-gray-300">Show password</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="notifEditPasswordModalContainer" class="col-span-1">

                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button data-modal-target="overviewProfileModal" data-modal-toggle="overviewProfileModal" type="button" onclick="closeEditPass()" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Kembali
                </button>
                <button type="button" id="btnSubmitEditPassword" onclick="EditPassword()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-40">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>

<?php
} else {
?>

<header>
    <nav class="fixed w-screen shadow-md bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800 z-100 top-0">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="../views" class="flex items-center">
                <img src="../assets/images/logo.png" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo"/>
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">XSPORTS</span>
            </a>
            <div class="flex items-center lg:order-2">
                <a href="../auth/login" class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Masuk</a>
                <a href="../auth/register" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Daftar</a>
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="../views" class="<?php if(@$current_page == 'home'){echo "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white";}else{echo "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700";} ?>">Home</a>
                    </li>
                    <li>
                        <a href="venues" class="<?php if(@$current_page == 'venues'){echo "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white";}else{echo "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700";} ?>">Venue</a>
                    </li>
                    <li>
                        <a href="book" class="<?php if(@$current_page == 'book'){echo "block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0 dark:text-white";}else{echo "block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700";} ?>">Booking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<?php
}
?>