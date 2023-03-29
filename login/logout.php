<?php
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>
    alert('Maaf, Tidak Bisa Logout Tanpa Login Terlebih Dahulu!');
    document.location.href='../login/login.php';</script>";
    exit;
}

$_SESSION = [];
session_unset();
session_destroy();
echo "<script>alert('Anda Telah Logout'); location.href = '../index.php';</script>";