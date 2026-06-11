<?php

$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

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

header("Location: roti.php");

?>