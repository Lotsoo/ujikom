<?php
include '../config/app.php';

// if (!isset($_SESSION['login'])) {
//     echo "<script>
//     alert('Maaf, Untuk Mengakses Halaman Ini Anda Harus Login Terlebih Dahulu!');
//     document.location.href='../login/login.php';</script>";
//     exit;
// }

$id_kamar = (int)$_GET['id_kamar'];
if(delete_kamar($id_kamar)>0){
    echo "
    <script>
    alert('Data Kamar Berhasil Dihapus');
    document.location.href='kamar.php'
    </script>
    ";
} else{
    echo "
    <script>
    alert('Data Kamar Gagal Dihapus');
    document.location.href='kamar.php'
    </script>
    ";
}
?>