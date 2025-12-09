<?php
session_start();
include "koneksi.php";
if (isset($_SESSION['id_pengguna'])) {
    if ($_SESSION['peran'] == 'admin' ) header("Location: admin/dashboard.php");
    else header("Location: client/dashboard.php");
    exit;
}
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = mysqli_real_escape_string($con, $_POST['nama_pengguna']);
    $p = mysqli_real_escape_string($con, $_POST['kata_sandi']);
    $q = mysqli_query($con, "SELECT * FROM pengguna WHERE nama_pengguna='$u' AND kata_sandi='$p' LIMIT 1");
    if ($q && mysqli_num_rows($q)>0) {
        $row = mysqli_fetch_assoc($q);
        $_SESSION['id_pengguna'] = $row['id_pengguna'];
        $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        $_SESSION['peran'] = $row['peran'];
        if ($row['peran']=='admin') header("Location: admin/dashboard.php");
        else header("Location: client/dashboard.php");
        exit;
    } else $msg = "Username atau password salah.";
}
?>
<!DOCTYPE html>
<html><head><title>Login</title></head>
<body>
  <h2>Login</h2>
  <?php if($msg) echo "<p style='color:red;'>$msg</p>"; ?>
  <form method="post">
    <label>Username</label><br><input type="text" name="nama_pengguna" required><br>
    <label>Password</label><br><input type="password" name="kata_sandi" required><br>
    <button type="submit">Login</button>
  </form>
</body></html>