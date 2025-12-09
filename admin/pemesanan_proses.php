<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin' && $_SESSION['peran']!='petugas')) die("Akses ditolak");
$id = (int)$_GET['id'];
$q = mysqli_query($con, "SELECT p.*, k.nomor_kamar FROM pemesanan p JOIN kamar k ON p.id_kamar=k.id_kamar WHERE p.id_pemesanan=$id");
if (!$q || mysqli_num_rows($q)==0) die("Pemesanan tidak ditemukan.");
$r = mysqli_fetch_assoc($q);
  
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $status = mysqli_real_escape_string($con, $_POST['status']);
    mysqli_query($con, "UPDATE pemesanan SET status='$status' WHERE id_pemesanan=$id");
    // jika status jadi 'batal' atau 'selesai', kamar jadi tersedia
    if ($status == 'batal' || $status == 'selesai') {
        mysqli_query($con, "UPDATE kamar SET status='tersedia' WHERE id_kamar=".$r['id_kamar']);
    } elseif ($status == 'checkin') {
        mysqli_query($con, "UPDATE kamar SET status='terisi' WHERE id_kamar=".$r['id_kamar']);
    }
    header("Location: pemesanan_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html><head><title>Proses Pemesanan</title><link rel="stylesheet" href="../assets/style.css"></head>
<body>
  <h2>Proses Pemesanan #<?=$r['id_pemesanan']?></h2>
  <p><strong>Nama Tamu:</strong> <?=htmlspecialchars($r['nama_tamu'])?></p>
  <p><strong>Kamar:</strong> <?=$r['nomor_kamar']?></p>
  <p><strong>Tanggal:</strong> <?=$r['tanggal_masuk']?> s/d <?=$r['tanggal_keluar']?></p>
  <p><strong>Status sekarang:</strong> <?=$r['status']?></p>

  <form method="post">
    <label>Ubah status:</label><br>
    <select name="status">
      <option value="dipesan" <?=$r['status']=='dipesan'?'selected':''?>>dipesan</option>
      <option value="checkin" <?=$r['status']=='checkin'?'selected':''?>>checkin</option>
      <option value="selesai" <?=$r['status']=='selesai'?'selected':''?>>selesai</option>
      <option value="batal" <?=$r['status']=='batal'?'selected':''?>>batal</option>
    </select><br><br>
    <button type="submit">Simpan</button> <a href="pemesanan_list.php">Batal</a>
  </form>
</body></html>
