<?php 
session_start();
include "koneksi.php";

// echo "koneksi berhasil";

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Kasir Toko Roti</title>
    <link rel="stylesheet" href="assets/style_login.css">
    <style>
        body{
            background: #e6eeff;
            color: #01a8f8;
        }
    </style>
</head>
<body>

<?php include "header.html"; ?> 
<!-- <header class="kepala">
    <h1>Selamat Datang di Toko Roti Ghaisan</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a> 
    </nav>
</header> -->

<h2 class="section-title">Silahkan login telebih dahulu</h2>

     <div class="section"> 
    <div class="kotak">
        <h3>LOGIN</h3>

        <div class="forum">
        <form action="cek_login.php" method="POST">
            <label id="label" >Username</label><br>        
            <input type="text" placeholder="username" name="username" required/><br><br>
            
            <label id="label">Password</label><br>
            <input type="password" placeholder="password" name="password" required/><br><br>        
            
            <button class="tombol" type="submit" name="login">Login</button>    
        </form>
        </div>
    </div>
    </div>
    <br><br><br><br><br>
    <?php include "footer.html" ?>

</body>
</html>