<?php
$koneksi = new mysqli("localhost", "root", "", "xsports");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$query = "SELECT * FROM orders";
$result = $koneksi->query($query);

echo "<table border='1' cellpadding='5'>
<tr>
    <th>id_order</th>
    <th>name</th>
    <th>bukti (gambar)</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id_order'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";

    // Tampilkan gambar inline base64 jika tersedia
    if (!empty($row['bukti'])) {
        $type = "image/jpeg/jpg"; // Default, bisa kamu ubah sesuai jenis file
        $base64 = base64_encode($row['bukti']);
        echo "<td><img src='data:$type;base64,$base64' width='100'></td>";
    } else {
        echo "<td>Tidak ada bukti</td>";
    }

    echo "</tr>";
}
echo "</table>";

$koneksi->close();
?>
