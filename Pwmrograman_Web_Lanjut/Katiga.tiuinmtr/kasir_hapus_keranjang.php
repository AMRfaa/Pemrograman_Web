<?php

session_start();

unset($_SESSION['cart'][$_GET['id']]);

$_SESSION['cart'] =
    array_values($_SESSION['cart']);

header("Location: kasir_transaksi.php");
