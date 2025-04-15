<?php
// Pastikan folder 'uploads/' ada dan bisa ditulisi
// $target_dir = "../core/uploads/";
// $filename = basename($_FILES["file"]["name"]);
// $target_file = $target_dir . $filename;

// // Upload ke server
// if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
//     echo "File berhasil diupload.";

//     // Simpan path ke database
//     $conn = new mysqli("localhost", "root", "", "xsports");
//     $path = $conn->real_escape_string($target_file);
    // $conn->query("INSERT INTO orders (bukti, id_user, name, telephone, email, sport, id_venue, tanggal_sewa, jam_mulai, jam_selesai, payment, biaya, status) VALUES ('$path', 1, 'dummy', '8', 'dummy', 'tennis', 1, '2025-04-15', '10:00:00', '12:00:00', 'bca', 100000, 'active')");

//     echo " dan path tersimpan di database.";
// } else {
//     echo "Gagal upload file.";
// }
?>

<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "xsports");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Periksa apakah file diunggah
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $nama_file = $_FILES['file']['name'];
    $tipe_file = $_FILES['file']['type'];
    $data_file = addslashes(file_get_contents($_FILES['file']['tmp_name'])); // ESCAPE isi file

    // Eksekusi query langsung
    $sql = "INSERT INTO orders (bukti, id_user, name, telephone, email, sport, id_venue, tanggal_sewa, jam_mulai, jam_selesai, payment, biaya, status) VALUES ('$data_file', 1, 'dummy', '8', 'dummy', 'tennis', 1, '2025-04-15', '10:00:00', '12:00:00', 'bca', 100000, 'active')";

    if ($koneksi->query($sql)) {
        echo "File berhasil disimpan ke database.";
    } else {
        echo "Gagal menyimpan file: " . $koneksi->error;
    }
} else {
    echo "Tidak ada file diunggah.";
}
?>




<form method="post" enctype="multipart/form-data">
  <input type="file" name="file">
  <button type="submit">Upload</button>
</form>
