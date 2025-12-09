<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['id_pengguna'])) header("Location: ../login.php");
$id = (int)$_SESSION['id_pengguna'];
$q = mysqli_query($con, "SELECT p.*, k.nomor_kamar FROM pemesanan p 
                         JOIN kamar k ON p.id_kamar=k.id_kamar 
                         WHERE p.id_pengguna=$id ORDER BY p.id_pemesanan DESC");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Pemesanan Saya</title>
</head>

<body>
  <h2>Pemesanan Saya</h2>
  <a href="dashboard.php">Kembali</a>
  <hr>
  <?php while ($r = mysqli_fetch_assoc($q)): ?>
    <strong>ID:</strong> <?= $r['id_pemesanan'] ?><br>
    <strong>Kamar:</strong> <?= $r['nomor_kamar'] ?><br>
    <strong>Tanggal:</strong> <?= $r['tanggal_masuk'] ?> s/d <?= $r['tanggal_keluar'] ?><br>
    <strong>Total:</strong> <?= $r['total_harga'] ?><br>
    <strong>Status:</strong> <?= $r['status'] ?><br>
  <?php endwhile; ?>
</body>

</html>