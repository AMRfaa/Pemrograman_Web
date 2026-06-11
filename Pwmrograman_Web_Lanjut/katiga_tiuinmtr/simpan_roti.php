<?php

$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

$nama = $_POST['nama_roti'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

mysqli_query($koneksi,

"INSERT INTO roti
(nama_roti,harga,stok)

VALUES

('$nama','$harga','$stok')

");

header("Location: roti.php");

?>