<?php

session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi,
"SELECT * FROM users
WHERE username='$username'
AND password='$password'");

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    if($data['role']=="admin"){
        header("Location: admin_dashboard.php");
    }else{
        header("Location: kasir_dashboard.php");
    }

}else{
    echo "Username atau Password Salah";
}

?>