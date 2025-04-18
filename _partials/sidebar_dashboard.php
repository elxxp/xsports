<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
        <a href="https://flowbite.com" class="flex ms-2 md:me-24">
          <img src="../assets/images/logo.png" class="h-8 me-3" alt="FlowBite Logo"/>
          <div class="inline">
             <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Dashboard</span>
          </div>
        </a>
      </div>
      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="../assets/images/pfp-placeholder.jpg"/>
              </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  <?= $_SESSION['s_nama'] ?>
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  <?= $_SESSION['s_email'] ?>
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                </li>
                <li>
                  <a href="../auth/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Keluar</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="../dashboard" class="flex items-center py-2 px-3 gap-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-regular fa-house w-7 text-center"></i>
               <span class="">Dashboard</span>
            </a>
         </li>
         <li>
            <button type="button" aria-controls="menu-pesanan" data-collapse-toggle="menu-pesanan" class="flex items-center w-full py-2 px-3 gap-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                  <i class="fa-regular fa-envelope-open-dollar w-7"></i>
                  <span class="flex-1 text-left rtl:text-right whitespace-nowrap">Pesanan</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="menu-pesanan" class="hidden py-2 px-4">
                <li>
                   <a href="daftar_pesanan" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Daftar pesanan</a>
                </li>
                <li>
                    <a href="verifikasi_pesanan" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Verifikasi pesanan</a>
                </li>
            </ul>
         </li>
         <li>
            <button type="button" aria-controls="menu-venue" data-collapse-toggle="menu-venue" class="flex items-center w-full py-2 px-3 gap-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                  <i class="fa-regular fa-shuttlecock w-7"></i>
                  <span class="flex-1 text-left rtl:text-right whitespace-nowrap">Venue</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="menu-venue" class="hidden py-2 px-4">
                <li>
                   <a href="daftar_venue" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Daftar venue</a>
                </li>
                <li>
                    <a href="#" class="flex items-center w-full py-2 px-4 text-gray-900 transition duration-75 rounded-lg ml-5 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tambah venue</a>
                </li>
            </ul>
         </li>
         <li>
            <a href="../dashboard" class="flex items-center py-2 px-3 gap-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-regular fa-users w-7 text-center"></i>
               <span class="">Users</span>
            </a>
         </li>
         <li>
            <a href="../dashboard" class="flex items-center py-2 px-3 gap-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="fa-regular fa-person-walking w-7 text-center"></i>
               <span class="">Activity log</span>
            </a>
         </li>
      </ul>
   </div>
</aside>