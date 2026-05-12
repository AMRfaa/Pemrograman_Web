<?php 
    include "database.php";

    $info_register = "";

    if(isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $no_hp = $_POST["no_hp"];
        $email = $_POST["email"];

        $memasukkan_data = "INSERT INTO users (username, password, no_hp, email) VALUES 
        ('$username', '$password', '$no_hp', '$email')";

        if($db->query($memasukkan_data)) {
            $info_register = "INGFO DITERIMA, SILAHKAN KEMBALI KE HALAMAN LOGIN";
        }else {
            $info_register = "NT, KATA PAK RT MENDING COBA LAGI DAH";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/style.css"> 
</head>
<body>
    <?php include "layout/header.html" ?>
    <h3>DAFTAR AKUN</h3>
    
    <i><?= $info_register ?></i>

    <form action="register.php" method="POST">
        <label>Username</label>
        <br>        
        <input type="text" placeholder="username" name="username"/> 
        <br>        
        <br>

        <label>Password</label>
        <br>
        <input type="password" placeholder="password" name="password"/> 
        <br>
        <br>

        <label>No HP</label>
        <br>
        <input type="int" placeholder="masukkan nomor" name="no_hp"/> 
        <br>
        <br> 

        <label>Email</label>
        <br>
        <input type="text" placeholder="masukkan email" name="email"/> 
        <br>        
        <br>

        <button type="submit" name="register">Daftar</button>    
        <button type="submit" name="register"><a href="login.php">Login</a></button>    
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>