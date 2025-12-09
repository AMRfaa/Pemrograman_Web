<?php
session_start();
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin')) {
    die("Akses ditolak. <a href='../login.php'>Login</a>");
}
?>
<!DOCTYPE html>
<html><head><title>Dashboard Admin</title></head>
<body>
  <h2>Dashboard (<?=($_SESSION['nama_lengkap'])?>)</h2>
  <nav>
    <a href="kamar_list.php">Kelola Kamar</a> |
    <a href="pemesanan_list.php">Kelola Pemesanan</a> |
    <a href="../logout.php">Logout</a>
  </nav>
  <p>Gunakan menu di atas untuk mengelola kamar dan pemesanan.</p>
</body></html>
