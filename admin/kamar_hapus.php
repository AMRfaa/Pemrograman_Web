<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['peran']) || ($_SESSION['peran']!='admin')) die("Akses ditolak");

$id = (int)$_GET['id'];
//sebelum hapus, cek apakah kamar ada pemesanan (opsional)
mysqli_query($con, "DELETE FROM kamar WHERE id_kamar=$id");
header("Location: kamar_list.php");
exit;
