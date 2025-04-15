<?php
session_start();
require '../core/app.php';

@$usermail = $_POST['usermail'];
@$password = $_POST['password'];

if($usermail != "" && $password != "") {
    @$usermail = htmlspecialchars($usermail);
    @$password = htmlspecialchars($password);

    $db = new Database();
    $koneksi = $db->get();
    
    $account = new Account($koneksi);
    $login = $account->login($usermail, md5($password));

    if ($login->num_rows > 0) {
        $data = $login->fetch_assoc();
        $_SESSION['s_id'] = $data['id_user'];
        $_SESSION['user'] = $data['username'];
        $_SESSION['s_nama'] = $data['name'];
        $_SESSION['s_telp'] = $data['telephone'];
        $_SESSION['s_email'] = $data['email'];
        $_SESSION['level'] = $data['level'];

        if($data['level'] == 'manager') {
            header('Location: ../views/dashboard');
        } else {
            header('Location: ../views');
        }
    } else {
        $notif =
        '<div id="alertNontification" class="alertIn flex items-center mt-5 py-4 px-6 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
            <i class="fa-regular fa-circle-xmark"></i>
            <div class="ml-3 text-sm font-medium">
                Email atau password salah, coba lagi
            </div>
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
    <title>Login account</title>
</head>
<body class="bg-slate-100 dark:bg-slate-950">

<div class="fixed flex justify-center items-center w-full">
    <?= @$notif ?>
</div>
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="../assets/images/logo.png">
                XSPORTS    
            </div>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <form method="post" id="signin" class="space-y-4 md:space-y-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                            <input type="text" name="usermail" id="controlUsermail" value="<?= @$usermail ?>" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="exemple@mail.com" autocomplete="off">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="controlPassword" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="show" aria-describedby="show" type="checkbox" onclick="showPassword('show', 'password')" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="show" class="text-gray-500 dark:text-gray-300">Show password</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="buttonLogin" onclick="submitForm('signin', 'buttonLogin', 'Masuk')" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-40">Masuk</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Tidak memiliki akun? <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Daftar sekarang</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="../assets/js/main.js"></script>
<script>
    let inUser = document.getElementById('controlUsermail')
    inUser.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault()
        submitForm('signin', 'buttonLogin', 'Masuk')
        }
    })
    let inPass = document.getElementById('controlPassword')
    inPass.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault()
        submitForm('signin', 'buttonLogin', 'Masuk')
        }
    })
</script>
</html>