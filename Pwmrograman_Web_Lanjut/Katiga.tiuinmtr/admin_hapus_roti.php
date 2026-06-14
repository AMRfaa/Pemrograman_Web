<?php

include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi,

"DELETE FROM roti
WHERE id_roti='$id'");

header("Location: admin_data_roti.php");

?>