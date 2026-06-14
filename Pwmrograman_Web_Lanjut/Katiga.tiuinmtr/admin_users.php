<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/jquery.dataTables.min.css">
    <style>
        body{
            background: #081122;
            color: #01a8f8;
            margin: 10px;
        }
        ul{
            list-style-type: none;
            padding: 0;
        }
        h2 {
            color: #ffffff;
            padding-bottom: 10px;
            padding-top: 20px;
        }
        a {
            background: #0d1b34;
            color: #01a8f8;
            margin-bottom: 10px;
            text-decoration: none;
            color: #01a8f8;
        }
        .menu-item a::before {
            content: " ➕ "; 
        }
    </style>
</head>
<body>

    <h2>Data User</h2>
        <hr>
    <br>
    <br>
    <br>
    <ul class="menu">
        <li><a href="admin_dashboard.php">Kembali</a></li>
        <li class="menu-item"><a href="admin_tambah_user.php">Tambah User</a></li>

    </ul>
    
    <br><br>

    <table id="tabelusers" border="1" cellpadding="10">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data = mysqli_query(
            $koneksi,
            "SELECT * FROM users"
        );
        while ($d = mysqli_fetch_array($data)) {?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['username']; ?></td>
                <td><?= $d['no_hp']; ?></td>
                <td><?= $d['email']; ?></td>
                <td><?= $d['role']; ?></td>
                <td>
                    <a href="admin_edit_user.php?id=<?= $d['id']; ?>">Edit</a>
                    <a href="admin_hapus_user.php?id=<?= $d['id']; ?>"onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script src="assets/jquery-3.7.0.min.js"></script>
    <script src="assets/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#tabelusers').DataTable();

        });
    </script>
</body>

</html>