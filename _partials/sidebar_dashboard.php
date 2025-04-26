<?php
    $account = new Account(); $user = $account->getDataUser($_SESSION['s_id']);

    $_SESSION['s_nama'] = $user['name'];
    $_SESSION['s_telp'] = $user['telephone'];
    $_SESSION['s_email'] = $user['email'];
    $_SESSION['level'] = $user['level'];
?>
<nav class="fixed top-0 z-39 w-full bg-white border-b border-gray-200">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="../dashboard" class="flex ms-2 md:me-24">
          <img src="../assets/images/logo.png" class="h-8 me-3" alt="FlowBite Logo"/>
          <div class="inline">
             <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">Dashboard</span>
          </div>
        </a>
      </div>
      <div class="flex items-center">
         <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="../assets/images/pfp-placeholder.jpg"/>
              </button>
            </div>
            <button data-modal-target="confirmModalLogout" data-modal-toggle="confirmModalLogout" class="text-white ml-4 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2">Keluar</button>
            <div class="z-39 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900" role="none">
                  <?= $_SESSION['s_nama'] ?>
                </p>
                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                  <?= $_SESSION['s_email'] ?>
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a data-modal-target="overviewProfileModal" data-modal-toggle="overviewProfileModal" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile</a>
                </li>
                <li>
                  <a href="../auth/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Keluar</a>
                </li>
              </ul>
            </div>
         </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-38 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="../dashboard" class="flex items-center py-2 px-3 gap-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
               <i class="fa-regular fa-house w-7 text-center"></i>
               <span class="">Dashboard</span>
            </a>
         </li>
         <li>
            <button type="button" aria-controls="menu-pesanan" data-collapse-toggle="menu-pesanan" class="flex items-center w-full py-2 px-3 gap-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                  <i class="fa-regular fa-envelope-open-dollar w-7"></i>
                  <span class="flex-1 text-left rtl:text-right whitespace-nowrap">Pesanan</span>
                  <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="menu-pesanan" class="hidden py-2 px-4">
                <li>
                   <a href="daftar_pesanan" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100">Daftar pesanan</a>
                </li>
                <li>
                    <a href="verifikasi_pesanan" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100">Verifikasi pesanan</a>
                </li>
            </ul>
         </li>
         <li>
            <button type="button" aria-controls="menu-venue" data-collapse-toggle="menu-venue" class="flex items-center w-full py-2 px-3 gap-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100">
                  <i class="fa-regular fa-shuttlecock w-7"></i>
                  <span class="flex-1 text-left rtl:text-right whitespace-nowrap">Venue</span>
                  <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="menu-venue" class="hidden py-2 px-4">
                <li>
                   <a href="daftar_venue" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100">Daftar venue</a>
                </li>
                <li>
                    <a href="tambah_venue" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100">Tambah venue</a>
                </li>
            </ul>
         </li>
         <li>
            <a href="daftar_akun" class="flex items-center py-2 px-3 gap-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
               <i class="fa-regular fa-users w-7 text-center"></i>
               <span class="">Users</span>
            </a>
         </li>
      </ul>
   </div>
</aside>

<div id="confirmModalLogout" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
   <div class="relative p-4 w-full max-w-md h-full md:h-auto">
         <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="confirmModalLogout">
               <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
               <span class="sr-only">Close modal</span>
            </button>

            <p class="mb-2 mt-1 font-semibold text-gray-500"><i class="fa-regular fa-triangle-exclamation mx-2"></i>Keluar dari aplikasi?</p>
            <p class="mb-5 ml-2 text-sm text-gray-500">Tutup dashboard dan keluar dari aplikasi.</p>
            <div class="flex justify-end items-center space-x-2">
               <button data-modal-toggle="confirmModalLogout" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10">
                  kembali
               </button>
               <button onclick="location.href='../auth/logout'" class="transition py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">
                  keluar
               </button>
            </div>
         </div>
   </div>
</div>

<!-- profile overview modal -->
<div id="overviewProfileModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <div class="relative p-5 bg-white rounded-lg shadow  sm:p-6">
            <div class="mb-4 rounded-t sm:mb-5">
                <div class="flex items-center text-lg text-gray-900 md:text-xl ">
                    <h3 class="font-semibold">
                        Profile Overview
                        <p class="text-xs font-normal text-gray-500 ">
                            USER ID #<?= $user['id_user'] ?>
                        </p>
                    </h3>
                </div>
            </div>
            <dl>
                <div class="text-sm space-y-4 sm:space-y-2 rounded-lg border border-gray-100 bg-gray-50 p-5   mb-4 md:mb-6">
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 ">Nama lengkap</dt>
                        <dd class="font-medium text-gray-900  sm:text-end"><?= $user['name'] ?></dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 ">Email</dt>
                        <dd class="font-medium text-gray-900  sm:text-end"><?= $user['email'] ?></dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 ">No. Telp</dt>
                        <dd class="font-medium text-gray-900  sm:text-end"><?= $user['telephone'] ?></dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 ">Password</dt>
                        <dd data-modal-target="updatePasswordModal" data-modal-toggle="updatePasswordModal" onclick="closeOverview()" class="cursor-pointer underline font-medium text-blue-900  sm:text-end">Ubah password</dd>
                    </dl>
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal sm:mb-0 text-gray-500 ">Akun tedaftar</dt>
                        <dd class="font-medium text-gray-900  sm:text-end"><?= tanggalClean($user['waktu_daftar']) ?></dd>
                    </dl>
                </div>
            </dl>

            <div>
                <button data-modal-target="updateProfileModal" data-modal-toggle="updateProfileModal" onclick="closeOverview()" class="cursor-pointer w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2  :bg-blue-700 focus:outline-none :ring-blue-800">
                    Edit profile
                </button>        
                <button id="btnCloseOverview" data-modal-toggle="overviewProfileModal" class="cursor-pointer py-2.5 w-full px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 :ring-gray-700    :text-white :bg-gray-700">
                    Tutup
                </button>             
            </div>
        </div>
    </div>
</div>

<!-- edit profile modal -->
<div id="updateProfileModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <div class="relative p-5 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex items-center text-lg text-gray-900 md:text-xl ">
                <h3 class="font-semibold">
                    Update profile
                    <p class="text-xs font-normal text-gray-500 ">
                            USER ID#<?= $user['id_user'] ?>
                        </p>
                </h3>
                <button type="button" id="btnCloseEditPro" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :bg-gray-600 :text-white" data-modal-toggle="updateProfileModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="formEditProfile" action="../core/form/updProfile" method="post">
                <div class="grid gap-4 mb-4 sm:grid-cols-2 pt-5">
                    <div class="col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Nama lengkap</label>
                        <input type="text" name="name" id="controlEditName" value="<?= $user['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="<?= $user['name'] ?>" autocomplete="off">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Alamat email</label>
                        <input type="text" name="email" id="controlEditEmail" value="<?= $user['email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="<?= $user['email'] ?>" autocomplete="off">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 ">No. Telp</label>
                        <input type="text" name="phone" id="controlEditPhone" value="<?= $user['telephone'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="<?= $user['telephone'] ?>" autocomplete="off">
                    </div>
    
                    <div id="notifEditProfileModalContainer" class="col-span-2">
    
                    </div>
                </div>
            </form>
            <div class="flex items-center space-x-4">
                <button data-modal-target="overviewProfileModal" data-modal-toggle="overviewProfileModal" type="button" onclick="closeEditPro()" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  :bg-gray-700 :ring-gray-800">
                    Kembali
                </button>
                <button type="button" id="btnSubmitEditProfile" onclick="EditProfile()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  :bg-blue-700 :ring-blue-800 disabled:opacity-40">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>

<!-- edit password modal -->
<div id="updatePasswordModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden pt-15 fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <div class="relative p-5 bg-white rounded-lg shadow  sm:p-5">
            <div class="flex items-center text-lg text-gray-900 md:text-xl ">
                <h3 class="font-semibold">
                    Update password
                    <p class="text-xs font-normal text-gray-500 ">
                            USER ID#<?= $user['id_user'] ?>
                        </p>
                </h3>
                <button type="button" id="btnCloseEditPass" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :bg-gray-600 :text-white" data-modal-toggle="updatePasswordModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="grid gap-4 mb-4 sm:grid-cols-1 pt-5">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Password lama</label>
                    <input type="password" name="passOld" id="controlEditPassOld" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="Masukan password sebelumnya" autocomplete="off">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Buat password baru (min. 8)</label>
                    <input type="password" name="passCurr" id="controlEditPassCurr" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="Buat password" autocomplete="off">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Konfirmasi password</label>
                    <input type="password" id="controlEditPassConfirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     :ring-blue-500 :border-blue-500" placeholder="Masukan ulang password" autocomplete="off">

                    <div class="flex items-center justify-between mt-2 ml-1">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="show" aria-describedby="show" type="checkbox" onclick="showEditPassword('controlEditPassOld', 'controlEditPassCurr')" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300   :ring-blue-600 ">
                            </div>
                            <div class="ml-2 text-sm">
                                <label for="show" class="text-gray-500 ">Show password</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="notifEditPasswordModalContainer" class="col-span-1">

                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button data-modal-target="overviewProfileModal" data-modal-toggle="overviewProfileModal" type="button" onclick="closeEditPass()" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  :bg-gray-700 :ring-gray-800">
                    Kembali
                </button>
                <button type="button" id="btnSubmitEditPassword" onclick="EditPassword()" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  :bg-blue-700 :ring-blue-800 disabled:opacity-40">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>
