<?php
require '../app.php';

$db = new Database();

$olahraga = $_POST['olahraga'];
$venue = $_POST['venue'];
$tanggal = $_POST['tanggal'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];

$sql = "SELECT * FROM orders 
        WHERE sport = '$olahraga'
        AND tanggal_sewa = '$tanggal'
        AND id_venue = '$venue'
        AND ('$jam_mulai' < jam_selesai AND '$jam_selesai' > jam_mulai)
        AND status = 'active'";

if(!($olahraga == null || $olahraga == 'null') && !($venue == null || $venue == 'null')) {
    if($tanggal != null && !($jam_mulai == null || $jam_mulai == 'null') && !($jam_selesai == null || $jam_selesai == 'null')) {
        $cek = $db->query($sql);
        if($cek->num_rows == 0) {
            $output = '
            <div class="flex items-center p-3 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <i class="fa-regular fa-circle-check mr-2"></i>
                <div>
                <span class="font-medium">Yeay, jadwal yang kamu pilih tersedia!</span>
                </div>
            </div>
            ';
            
        } else {
            foreach($cek as $data) {
                @$listJadwal .= '<p class="text-black text-xs mt-0.5 dark:text-white">Lap. '.$data["venue"].' '.substr($data["jam_mulai"], 0, 5).' - '.substr($data["jam_selesai"], 0, 5).' Telah dibooking</p>';
            }

            $output = '
            <div class="flex items-start p-3 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <i class="fa-regular fa-circle-xmark mr-2 relative mt-1"></i>
                <div>
                    <span class="font-medium">Yah, jadwal sudah di booking. Coba jadwal lain</span>
                    <div class="mt-1">
                        <p class="text-xs text-gray-500">Berikut adalah jadwal yang sudah dibooking:</p>
                        '. @$listJadwal .'
                    </div>
                </div>
            </div>
            ';        
        }

    } else {
        $output = '
        <div class="flex items-center p-3 text-sm text-orange-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-orange-300 dark:border-yellow-800" role="alert">
            <i class="fa-regular fa-circle-exclamation mr-2"></i>
            <div>
                <span class="font-medium">Atur jadwal sewa terlebih dahulu</span>
            </div>
        </div>
        ';
    }
    
} else {
    $output = '
    <div class="flex items-center p-3 text-sm text-orange-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-orange-300 dark:border-yellow-800" role="alert">
        <i class="fa-regular fa-circle-exclamation mr-2"></i>
        <div>
            <span class="font-medium">Pilih jenis olahraga dan lapangan terlebih dahulu</span>
        </div>
    </div>
    ';
}



?>

<?= @$output ?>
<?php 

?>
