<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin')) die("Akses ditolak");

$q = mysqli_query($con, "SELECT p.*, k.nomor_kamar, u.nama_lengkap AS nama_petugas FROM pemesanan p JOIN kamar k ON p.id_kamar=k.id_kamar JOIN pengguna u ON p.id_pengguna=u.id_pengguna ORDER BY p.id_pemesanan DESC");
?>
<!DOCTYPE html>
<html><head><title>Daftar Pemesanan</title></head>
<body>
  <h2>Daftar Pemesanan</h2>
  <a href="dashboard.php">Kembali</a><hr>
  <?php while($r = mysqli_fetch_assoc($q)): ?>
      <strong>ID:</strong> <?=$r['id_pemesanan']?><br>
      <strong>Nama Tamu:</strong> <?=htmlspecialchars($r['nama_tamu'])?><br>
      <strong>Kamar:</strong> <?=$r['nomor_kamar']?><br>
      <strong>Tanggal:</strong> <?=$r['tanggal_masuk']?> s/d <?=$r['tanggal_keluar']?><br>
      <strong>Total:</strong> <?=$r['total_harga']?><br>
      <strong>Status:</strong> <?=$r['status']?><br>
      <a href="pemesanan_proses.php?id=<?=$r['id_pemesanan']?>">Proses / Ubah Status</a>
  <?php endwhile; ?>
</body></html>
