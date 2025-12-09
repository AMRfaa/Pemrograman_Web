<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin')) die("Akses ditolak");

$id = (int)$_GET['id'];
$q = mysqli_query($con, "SELECT * FROM kamar WHERE id_kamar=$id");
if (!$q || mysqli_num_rows($q)==0) die("Kamar tidak ditemukan");
$r = mysqli_fetch_assoc($q);

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $no = mysqli_real_escape_string($con, $_POST['nomor_kamar']);
    $jenis = mysqli_real_escape_string($con, $_POST['jenis_kamar']);
    $kap = (int)$_POST['kapasitas'];
    $harga = (float)$_POST['harga'];
    $status =mysqli_real_escape_string($con, $_POST['status']);
    mysqli_query($con, "UPDATE kamar SET nomor_kamar='$no', jenis_kamar='$jenis', kapasitas=$kap, harga_per_malam=$harga, status='$status' WHERE id_kamar=$id");
    header("Location: kamar_list.php");
    exit;
}
?>
<!DOCTYPE html>
<html><head><title>Edit Kamar</title><link rel="stylesheet" href="../assets/style.css"></head>
<body>
  <h2>Edit Kamar</h2>
  <form method="post">
    <label>Nomor Kamar</label><br><input type="text" name="nomor_kamar" value="<?=($r['nomor_kamar'])?>" required><br>
    <label>Jenis Kamar</label><br><input type="text" name="jenis_kamar" value="<?=($r['jenis_kamar'])?>" required><br>
    <label>Kapasitas</label><br><input type="number" name="kapasitas" value="<?=$r['kapasitas']?>" required><br>
    <label>Harga per malam</label><br><input type="number" name="harga" value="<?=$r['harga_per_malam']?>" required><br>
    <label>Status</label><br>
    <select name="status">
      <option value="tersedia" <?=$r['status']=='tersedia'?'selected':''?>>tersedia</option>
      <option value="terisi" <?=$r['status']=='terisi'?'selected':''?>>terisi</option>
      <option value="perbaikan" <?=$r['status']=='perbaikan'?'selected':''?>>perbaikan</option>
    </select><br><br>
    <button type="submit">Simpan</button> <a href="kamar_list.php">Batal</a>
  </form>
</body></html>
