<?php

include 'koneksi.php';

$nama = $_POST['nama_roti'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

mysqli_query($koneksi,

"INSERT INTO roti
(nama_roti,harga,stok)
VALUES
('$nama','$harga','$stok')

");

header("Location: admin_data_roti.php");

?>