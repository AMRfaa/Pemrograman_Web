<?php
session_start();
if (!isset($_SESSION['peran']) || $_SESSION['peran'] != 'admin') {
    echo "Akses ditolak. Hanya admin yang boleh membuka halaman ini.";
    exit;
}
?>

