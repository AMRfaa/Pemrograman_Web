<?php
// file: server/database.php
$hostname = "localhost";
$username = "root";
$password = "";
$nama_database = "kasir_toko_roti"; // Ubah nama database

$db= mysqli_connect($hostname, $username, $password, $nama_database);

if($db->connect_error) {
    echo "koneksi database rusak laaa";
    die("error cuy!");
}
?>