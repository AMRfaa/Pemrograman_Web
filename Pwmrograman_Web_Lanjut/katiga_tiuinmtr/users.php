<?php
$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if (!$koneksi) {
    die("Koneksi gagal");
}

// if(!isset($_SESSION['id'])){
//     header("Location: ../login.php");
//     exit;
// }

// if($_SESSION['role'] != 'admin'){
//     header("Location: ../login.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="../assets/jquery.dataTables.min.css">
    <style>
        body{
            background: #081122;
            color: #01a8f8;
        }

        a{
            display: block;
            margin-bottom: 10px;
        }
    </style>

</head>
<body>

    <h2>Data User</h2>
    <a href="tambah_user.php">Tambah User</a>

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
                    <a href="edit_user.php?id=<?= $d['id']; ?>">Edit</a>
                    <a href="hapus_user.php?id=<?= $d['id']; ?>"onclick="return confirm('Yakin ingin menghapus data ini?')">
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