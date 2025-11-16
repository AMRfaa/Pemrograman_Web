<?php
session_start();
include("koneksi.php");

$username = isset($_POST['username']) ? mysqli_real_escape_string($con, $_POST['username']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($con, $_POST['password']) : '';

if ($username !== "" && $password !== "") {
    $sql = "SELECT * FROM pengguna WHERE nama_pengguna='$username' AND kata_sandi='$password' LIMIT 1";
    $res = mysqli_query($con, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        // Simpan data penting ke session, termasuk peran
        $_SESSION['id_pengguna'] = $row['id_pengguna'];
        $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
        $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
        $_SESSION['peran'] = $row['peran'];   // <--- penting
        header("Location: home.php");
        exit;
    } else {
        echo "Username atau password salah. <a href='login.php'>Kembali</a>";
    }
} else {
    echo "Input kosong. <a href='login.php'>Kembali</a>";
}
?>
