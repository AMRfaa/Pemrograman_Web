<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) header("Location: ../login.php");
?>
<!DOCTYPE html>
<html><head><title>Dashboard</title>></head>
<body>
  <h2>Selamat Datang, <?=($_SESSION['nama_lengkap'])?></h2>
  <nav>
    <a href="pesan_kamar.php">Pesan Kamar</a> |
    <a href="pemesanan_saya.php">Pemesanan Saya</a> |
    <a href="../logout.php">Logout</a>
  </nav>
</body></html>
