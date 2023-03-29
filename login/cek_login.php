<?php
session_start();
include '../config/app.php';


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $_SESSION['login'] = $_POST['login'];
    
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);
    
    if ($cek > 0) {
        $result = mysqli_fetch_assoc($query);
        if ($result['level'] == 'admin') {
            $_SESSION['nama_user'] = $result['nama_user'];
            $_SESSION['level'] = 'admin';
            echo "<script>alert('Login Berhasil'); location.href = '../admin/index.php';</script>";
        } else if ($result['level'] == 'resepsionis') {
            $_SESSION['nama_user'] = $result['nama_user'];
            $_SESSION['level'] = 'resepsionis';
            echo "<script>alert('Login Berhasil'); location.href = '../resepsionis/index.php';</script>";
        } else if ($result['level'] == 'tamu') {
            $_SESSION['nama_user'] = $result['nama_user'];
            $_SESSION['level'] = 'tamu';
            echo "<script>alert('Login Berhasil'); location.href = '../tamu/index.php';</script>";
        }     
        else {
            echo "<script>alert('Anda Tidak Punya Hak Akses'); location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Password & username salah'); location.href = 'login.php';</script>";
    }
}
