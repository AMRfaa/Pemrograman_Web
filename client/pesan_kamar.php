<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['id_pengguna'])) header("Location: ../login.php");

$res = mysqli_query($con, "SELECT * FROM kamar WHERE status='tersedia' ORDER BY id_kamar");
?>
<!DOCTYPE html>
<html><head><title>Pesan Kamar</title></head>
<body>
  <h2>Pilih Kamar (Tersedia)</h2>
  <?php while($r = mysqli_fetch_assoc($res)): ?><br>
      <strong>Nomor:</strong> <?=($r['nomor_kamar'])?><br>
      <strong>Jenis:</strong> <?=($r['jenis_kamar'])?><br>
      <strong>Harga/malam:</strong> <?=$r['harga_per_malam']?><br>
      <a href="simpan_pemesanan.php?id=<?=$r['id_kamar']?>">Pesan Sekarang</a><br>
  <?php endwhile; ?>
  <p><a href="dashboard.php">Kembali</a></p>
</body></html>
