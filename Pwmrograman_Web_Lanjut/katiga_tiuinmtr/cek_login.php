<?php

session_start();
$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

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
        header("Location: dashboard.php");
    }else{
        header("Location: dashboard_kasir.php");
    }

}else{
    echo "Username atau Password Salah";
}

?>