<?php
include '../layouts/header_resepsionis.php';

if (!isset($_SESSION['login'])) {
    echo "<script>
    alert('Maaf, Untuk Mengakses Halaman Ini Anda Harus Login Terlebih Dahulu!');
    document.location.href='../login/login.php';</script>";
}


if($_SESSION['level'] == 'admin'){
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../admin/index.php';
    </script>"; 
    exit;
} else if($_SESSION['level'] == 'tamu'){
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../tamu/index.php';
    </script>"; 
    exit;
}

$data_pemesanan = mysqli_query($koneksi, "SELECT * FROM pemesanan");
$pemesanan = mysqli_num_rows($data_pemesanan);
$hari = hari();
$bulan = bulan();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-end">
                <div class="col-sm-6 text-right">
                    <span class="ini_jam" style="font-size: 20px;">
                        Hari <?= $hari,  date(' d '), $bulan, date(' Y'); ?>, Jam
                        <span id="jam"></span>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang, Resepsionis <?= $_SESSION['nama_user']; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $pemesanan; ?></h3>

                            <p>Pesanan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <a href="pemesanan.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include '../layouts/footer_resepsionis.php';
?>