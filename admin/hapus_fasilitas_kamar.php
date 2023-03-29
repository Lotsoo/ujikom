<?php
include '../config/app.php';

$id_fasilitas = (int)$_GET['id_fasilitas'];
if(delete_fasilitas($id_fasilitas)>0){
    echo "
    <script>
    alert('Data Fasilitas Kamar Berhasil Dihapus');
    document.location.href='fasilitas_kamar.php'
    </script>
    ";
} else{
    echo "
    <script>
    alert('Data Fasilitas Kamar Gagal Dihapus');
    document.location.href='fasilitas_kamar.php'
    </script>
    ";
}
?>