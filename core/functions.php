<?php
function tanggalClean($tanggal){
    $timestamp = strtotime($tanggal);

    $hari = date('l', $timestamp);
    $tgl  = date('d', $timestamp);
    $bulan = date('F', $timestamp);
    $tahun = date('Y', $timestamp);

    $hari_indonesia = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulan_indonesia = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    echo $hari_indonesia[$hari] . ", $tgl " . $bulan_indonesia[$bulan] . " $tahun";
}

function levelFilter(){
    if(isset($_SESSION['level'])){
        if($_SESSION['level'] == 'admin'){
            header('Location: ../dashboard');
        }
    }
}
function staffOnly(){
    if($_SESSION['level'] != 'admin'){
        header('Location: ../views');
    }
}