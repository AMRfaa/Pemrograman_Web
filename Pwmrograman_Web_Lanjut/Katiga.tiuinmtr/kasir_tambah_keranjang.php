<?php

session_start();
include 'koneksi.php';

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

header("Location: kasir_transaksi.php");

?>