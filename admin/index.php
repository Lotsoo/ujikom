<?php
include '../layouts/header_admin.php';

if (!isset($_SESSION['login'])) {
    echo "<script>
    alert('Maaf, Untuk Mengakses Halaman Ini Anda Harus Login Terlebih Dahulu!');
    document.location.href='../login/login.php';</script>";
    exit;
}

if($_SESSION['level'] == 'resepsionis'){
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../resepsionis/index.php';
    </script>"; 
    exit;
} if($_SESSION['level'] == 'tamu'){
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../tamu/index.php';
    </script>"; 
    exit;
}

$data_kamar = mysqli_query($koneksi, "SELECT * FROM kamar");
$kamar = mysqli_num_rows($data_kamar);

$data_fasilitas = mysqli_query($koneksi, "SELECT * FROM fasilitas_kamar");
$fasilitas = mysqli_num_rows($data_fasilitas);

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
                        Hari <?= $hari,  date(' d '), $bulan, date(' Y '); ?>, Jam
                        <span id="jam"></span>
                    </span>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang, Admin <?= $_SESSION['nama_user']; ?></h1>
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
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $kamar;  ?></h3>
                            <p>Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <a href="kamar.php" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $fasilitas; ?></h3>
                            <p>Fasilitas Kamar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hotel"></i>
                        </div>
                        <a href="fasilitas_kamar.php" class="small-box-footer">Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include '../layouts/footer_admin.php';
?>