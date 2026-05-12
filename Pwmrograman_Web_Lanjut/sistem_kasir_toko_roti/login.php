<?php 
include "database.php";
session_start();
$info_login = "";

if(isset($_SESSION["is_login"])) {
    // Kalau sudah login, arahkan sesuai jabatan
    if($_SESSION["role"] == "admin") {
        header("location: dashboard_admin.php");
    } else {
        header("location: dashboard_kasir.php");
    }
}
    
if (isset($_POST['login']))   {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $mencari = "SELECT * FROM users WHERE username ='$username' AND password ='$password'";
    $hasil_mencari = $db->query($mencari);

    if($hasil_mencari->num_rows > 0) {
        $data = $hasil_mencari->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["role"] = $data["role"]; // Simpan jabatannya di memori (session)
        $_SESSION["is_login"] = True;

        // PINTU GERBANGNYA DI SINI
        if($data["role"] == "admin"){
            header("location: dashboard_admin.php"); // Ke ruang Admin
        } else {
            header("location: dashboard_kasir.php"); // Ke ruang Kasir
        }
    } else {
        $info_login = "Akun tidak ditemukan, daftar dulu ngapa etdah";
    }
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Kasir</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include "layout/header.html" ?>
    
    <div style="text-align: center; margin-top: 20px;">
        <h3>LOGIN KASIR</h3>
        <i style="color: red;"><?= $info_login ?></i>

        <form action="login.php" method="POST">
            <label>Username</label><br>        
            <input type="text" placeholder="username" name="username" required/><br><br>
            
            <label>Password</label><br>
            <input type="password" placeholder="password" name="password" required/><br><br>        
            
            <button type="submit" name="login">Login</button>    
        </form>
    </div>

    <?php include "layout/footer.html" ?>
</body>
</html>