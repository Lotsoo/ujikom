<?php
include '../config/app.php';

$id_pemesanan = (int)$_GET['id_pemesanan'];
if(delete_bukti($id_pemesanan)>0){
    echo "
    <script>
    alert('Data Bukti Berhasil Dihapus');
    document.location.href='pemesanan.php'
    </script>
    ";
} else{
    echo "
    <script>
    alert('Data Bukti Gagal Dihapus');
    document.location.href='pemesanan.php'
    </script>
    ";
}
?>