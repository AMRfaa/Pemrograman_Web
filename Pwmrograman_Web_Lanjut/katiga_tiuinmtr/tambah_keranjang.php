<?php

session_start();
$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

$id_roti = $_POST['id_roti'];
$jumlah = $_POST['jumlah'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT * FROM roti WHERE id_roti='$id_roti'"
    )
);

$item = [
    'id_roti' => $data['id_roti'],
    'nama_roti' => $data['nama_roti'],
    'harga' => $data['harga'],
    'jumlah' => $jumlah
];

$_SESSION['cart'][] = $item;

header("Location: transaksi.php");

?>