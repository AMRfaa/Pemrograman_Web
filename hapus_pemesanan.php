<?php
session_start();
include("koneksi.php");
if (!isset($_SESSION['peran']) || !in_array($_SESSION['peran'], ['admin','petugas'])) {
    echo "Akses ditolak"; exit;
}
if (isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  // ambil id_kamar dulu
  $q = mysqli_query($con, "SELECT id_kamar FROM pemesanan WHERE id_pemesanan=$id");
  if ($q && mysqli_num_rows($q)>0) {
    $r = mysqli_fetch_assoc($q);
    $id_kamar = (int)$r['id_kamar'];
    mysqli_query($con, "DELETE FROM pemesanan WHERE id_pemesanan=$id");
    mysqli_query($con, "UPDATE kamar SET status='tersedia' WHERE id_kamar=$id_kamar");
  }
}
header("Location: daftar_pemesanan.php");
exit;
?>
