<?php
session_start();
require '../core/app.php';
if(isset($_SESSION['s_id']) && isset($_SESSION['s_nama']) && isset($_SESSION['s_telp']) && isset($_SESSION['s_email']) && isset($_SESSION['level'])){
    header('location: ../views');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['name']) && @$_POST['name']){
        if(isset($_POST['email']) && @$_POST['email']){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                if(isset($_POST['phone']) && @$_POST['phone']){
                    if(strlen($_POST['phone']) > 10 && strlen($_POST['phone']) < 14){
                        if(isset($_POST['password']) && @$_POST['password']){
                            if(strlen($_POST['password']) >= 8){

                                @$name = htmlspecialchars($_POST['name']);
                                @$email = htmlspecialchars($_POST['email']);
                                @$phone = htmlspecialchars($_POST['phone']);
                                @$password = htmlspecialchars($_POST['password']);
                                
                                $account = new Account;
                                if ($account->register($name, $email, $phone, md5($password))) {
                                    
                                    setcookie('registerSuccess', 'ok', time() + 1, "/");
                                    header('location: login');
                                } else {
                                    $notif =
                                    '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                        <i class="fa-solid fa-circle-exclamation mr-2"></i>Email telah digunakan, gunakan yang lain
                                    </div>
                                    ';
                                }

                            } else {
                                $notif =
                                '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                    <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan password minimal 8 karakter
                                </div>
                                ';

                            }
                        } else {
                            $notif =
                            '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                                <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan password terlebih dahulu
                            </div>
                            ';
    
                        }
                    } else {
                        $notif =
                        '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                            <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan nomor telepon yang valid
                        </div>
                        ';
    
                    }
                } else {
                    $notif =
                    '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan nomor telepon terlebih dahulu
                    </div>
                    ';
        
                }
            } else {
                $notif =
                '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan alamat email yang valid
                </div>
                ';

            }
        } else {
            $notif =
            '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan alamat email terlebih dahulu
            </div>
            ';
    
        }
    } else {
        $notif =
        '<div id="alertNontification" class="alertIn fixed z-30 inset-x-0 mx-auto top-5 font-bold flex items-center justify-center w-fit text-xs text-red-600 bg-red-400/20 dark:bg-red-700/20 border border-red-300  dark:text-red-600 dark:border-red-500 rounded-lg px-3.5 py-2 mb-1">
            <i class="fa-solid fa-circle-exclamation mr-2"></i>Masukan nama lengkap terlebih dahulu
        </div>
        ';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../_partials/head.html'; ?>
    <title>Register account</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">

    <div id="alertContainer">
        <?= @$notif ?>
    </div>

    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="../views" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="../assets/images/logo.png">
                Xsports Indonesia
            </a>
            <div class="w-full bg-white rounded-xl shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <!-- <h1 class="text-2xl font-bold py-2 text-center">Daftar akun</h1> -->
                    <form method="post" id="signup" class="space-y-4 md:space-y-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama lengkap</label>
                            <input type="text" name="name" id="controlName" value="<?= @$_POST['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Budi slebew" autocomplete="off">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat email</label>
                            <input type="email" name="email" id="controlMail" value="<?= @$_POST['email'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="exemple@mail.com" autocomplete="off">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
                            <input type="number" name="phone" id="controlPhone" value="<?= @$_POST['phone'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="081X-XXX-XXX" autocomplete="off">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Buat password (min. 8)</label>
                            <input type="password" name="password" id="controlPassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="show" aria-describedby="show" type="checkbox" onclick="showPassword('show', 'controlPassword')" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="show" class="text-gray-500 dark:text-gray-300">Show password</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="buttonReg" onclick="submitForm('signup', 'buttonReg', 'Daftar')" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-40">Daftar</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Sudah memiliki akun? <a href="login" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Masuk sekarang</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="../assets/js/main.js"></script>
<script>
    document.getElementById('controlName').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault()
        submitForm('signup', 'buttonReg', 'Masuk')
        }
    })
    document.getElementById('controlMail').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault()
        submitForm('signup', 'buttonReg', 'Masuk')
        }
    })
    document.getElementById('controlPhone').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault()
        submitForm('signup', 'buttonReg', 'Masuk')
        }
    })
    document.getElementById('controlPassword').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault()
        submitForm('signup', 'buttonReg', 'Daftar')
        }
    })
</script>
</html>