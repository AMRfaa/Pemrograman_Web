<?php

$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM users
WHERE id='$id'");

$d = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body{
            background: #d8e6ff;
            color: #01a8f8;
        }
        </style>
    </style>
</head>
<body>
    
<h2>Edit User</h2>

<form action="update_user.php" method="POST">

<input type="hidden"
name="id"
value="<?= $d['id']; ?>">

Username
<br>

<input type="text"
name="username"
value="<?= $d['username']; ?>">

<br><br>

Password
<br>

<input type="text"
name="password"
value="<?= $d['password']; ?>">

<br><br>

No HP
<br>

<input type="text"
name="no_hp"
value="<?= $d['no_hp']; ?>">

<br><br>

Email
<br>

<input type="email"
name="email"
value="<?= $d['email']; ?>">

<br><br>

Role
<br>

<select name="role">

<option value="admin"
<?= $d['role']=="admin" ? "selected" : "" ?>>
Admin
</option>

<option value="kasir"
<?= $d['role']=="kasir" ? "selected" : "" ?>>
Kasir
</option>

</select>

<br><br>

<button type="submit">Update</button>

</form>
</body>
</html>