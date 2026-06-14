<?php

include 'koneksi.php';

$id = $_POST['id_roti'];
$nama = $_POST['nama_roti'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

mysqli_query($koneksi,

"UPDATE roti SET
nama_roti='$nama',
harga='$harga',
stok='$stok'
WHERE id_roti='$id'
");

header("Location: admin_data_roti.php");

?>