<?php
session_start();
if (!isset($_SESSION['nama_pengguna'])) {
  header("Location: login.php"); exit;
}
$peran = $_SESSION['peran'];
?>
<!DOCTYPE html><body>
  <h2>Halo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?> (<?php echo $peran; ?>)</h2>

  <?php if ($peran == 'admin'): ?>
    <a href="kamar.php">Kelola Kamar</a><br>
    <a href="jenis_kamar.php">Kelola Jenis Kamar</a><br>
    <a href="daftar_pemesanan.php">Daftar Pemesanan</a><br>
  <?php elseif ($peran == 'petugas'): ?>
    <a href="form_pemesanan.php">Tambah Pemesanan</a><br>
    <a href="daftar_pemesanan.php">Daftar Pemesanan</a><br>
  <?php else: /* tamu */ ?>
    <a href="form_pemesanan.php">Pesan Kamar</a><br>
    <a href="my_pemesanan.php">Pemesanan Saya</a><br>
  <?php endif; ?>

  <a href="proses_logout.php">Logout</a>
</body></html>
