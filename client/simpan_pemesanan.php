<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['id_pengguna'])) header("Location: ../login.php");

$id_kamar = (int)$_GET['id'];
$id_pengguna = (int)$_SESSION['id_pengguna'];
// default: check-in hari ini, keluar besok (bisa diperluas ke form)
$tanggal_masuk = date("Y-m-d");
$tanggal_keluar = date("Y-m-d", strtotime("+1 day"));

$q = mysqli_query($con, "SELECT harga_per_malam FROM kamar WHERE id_kamar=$id_kamar AND status='tersedia' LIMIT 1");
if (!$q || mysqli_num_rows($q) == 0) {
    die("Kamar tidak tersedia.");
}
$d = mysqli_fetch_assoc($q);
$harga = $d['harga_per_malam'];
$days = (($tanggal_keluar) - ($tanggal_masuk)) / (60 * 60 * 24);
if ($days <= 0) $days = 1;
$total = $harga * $days;

mysqli_query($con, "INSERT INTO pemesanan (id_pengguna, id_kamar, nama_tamu, tanggal_masuk, tanggal_keluar, total_harga) VALUES ($id_pengguna, $id_kamar, '{$_SESSION['nama_lengkap']}', '$tanggal_masuk', '$tanggal_keluar', $total)");
mysqli_query($con, "UPDATE kamar SET status='terisi' WHERE id_kamar=$id_kamar");
header("Location: pemesanan_saya.php");
exit;
