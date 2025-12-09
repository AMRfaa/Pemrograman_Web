<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin')) die("Akses ditolak");

$msg = "";
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $no = mysqli_real_escape_string($con, $_POST['nomor_kamar']);
    $jenis = mysqli_real_escape_string($con, $_POST['jenis_kamar']);
    $kap = (int)$_POST['kapasitas'];
    $harga = (float)$_POST['harga'];
    $cek = mysqli_query($con, "SELECT * FROM kamar WHERE nomor_kamar='$no'");
    if ($cek && mysqli_num_rows($cek)>0) $msg="Nomor kamar sudah ada.";
    else {
        mysqli_query($con, "INSERT INTO kamar (nomor_kamar, jenis_kamar, kapasitas, harga_per_malam) VALUES ('$no','$jenis',$kap,$harga)");
        header("Location: kamar_list.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html><head><title>Tambah Kamar</title></head>
<body>
  <h2>Tambah Kamar</h2>
  <?php if($msg) echo "<p style='color:red;'>$msg</p>"; ?>
  <form method="post">
    <label>Nomor Kamar</label><br><input type="text" name="nomor_kamar" required><br>
    <label>Jenis Kamar</label><br><input type="text" name="jenis_kamar" required><br>
    <label>Kapasitas</label><br><input type="number" name="kapasitas" required><br>
    <label>Harga per malam</label><br><input type="number" name="harga" required><br><br>
    <button type="submit">Simpan</button> <a href="kamar_list.php">Batal</a>
  </form>
</body></html>
