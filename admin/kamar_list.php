<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin')) die("Akses ditolak");

$res = mysqli_query($con, "SELECT * FROM kamar ORDER BY id_kamar DESC");
?>
<!DOCTYPE html>
<html><head><title>Daftar Kamar</title></head>
<body>
  <h2>Daftar Kamar</h2>
  <a href="kamar_tambah.php">+ Tambah Kamar</a> | <a href="dashboard.php">Kembali</a><hr>
  <?php while($r = mysqli_fetch_assoc($res)): ?>
    <div class="card">
      <strong>No:</strong> <?=($r['nomor_kamar'])?><br>
      <strong>Jenis:</strong> <?=($r['jenis_kamar'])?><br>
      <strong>Kapasitas:</strong> <?=$r['kapasitas']?><br>
      <strong>Harga/malam:</strong> <?=$r['harga_per_malam']?><br>
      <strong>Status:</strong> <?=$r['status']?><br>
      <a href="kamar_edit.php?id=<?=$r['id_kamar']?>">Edit</a> |
      <a href="kamar_hapus.php?id=<?=$r['id_kamar']?>" onclick="return confirm('Hapus kamar?')">Hapus</a>
    </div>
  <?php endwhile; ?>
</body></html>
