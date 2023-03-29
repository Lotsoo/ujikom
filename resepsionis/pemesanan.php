<?php
include '../layouts/header_resepsionis.php';
$data_pemesanan = select("SELECT * FROM pemesanan");


if (!isset($_SESSION['login'])) {
    echo "<script>
    alert('Maaf, Untuk Mengakses Halaman Ini Anda Harus Login Terlebih Dahulu!');
    document.location.href='../login/login.php';</script>";
}

if ($_SESSION['level'] == 'admin') {
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../admin/index.php';
    </script>";
    exit;
}
if ($_SESSION['level'] == 'tamu') {
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../tamu/index.php';
    </script>";
    exit;
}

if (isset($_POST['konfirmasi'])) {
    if (konfirmasi($_POST) > 0) {
        echo "<script>alert('Data Berhasil Diubah');
        document.location.href = 'pemesanan.php'; </script>";
    } else {
        echo "<script>alert('Data Gagal Diubah');
        document.location.href = '#'; </script>";
    }
}

if (isset($_POST['batal'])) {
    if (batal_konfirmasi($_POST) > 0) {
        echo "<script>alert('Data Berhasil Dibatalkan');
        document.location.href = 'pemesanan.php'; </script>";
    } else {
        echo "<script>alert('Data Gagal Dibatalkan');
        document.location.href = '#'; </script>";
    }
}
?>

<div class="">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pemesanan Hotel</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>No. Handphone</th>
                            <th>Email</th>
                            <th>Nama Tamu</th>
                            <th>Check in</th>
                            <th>Check out</th>
                            <th>Jumlah Kamar</th>
                            <th>Tipe Kamar</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;;
                        foreach ($data_pemesanan as $pemesanan) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $pemesanan['nama_pemesan']; ?></td>
                                <td><?= $pemesanan['nomor_hp']; ?></td>
                                <td><?= $pemesanan['email']; ?></td>
                                <td><?= $pemesanan['nama_tamu']; ?></td>
                                <td><?= $pemesanan['check_in']; ?></td>
                                <td><?= $pemesanan['check_out']; ?></td>
                                <td><?= $pemesanan['jumlah_kamar']; ?></td>
                                <td><?= $pemesanan['tipe_kamar']; ?></td>
                                <td><img src="../assets/img/<?= $pemesanan['bukti']; ?>" width="200px" alt="" data-toggle="modal" data-target="#modal-img"></td>
                                <td><?php if ($pemesanan['status'] == 1) { ?>
                                        <span class=" badge bg-warning">Belum dikonfirmasi</span>
                                    <?php } else if ($pemesanan['status'] == 2) { ?>
                                        <span class="badge bg-success">Sudah dikonfirmasi</span>
                                    <?php }

                                    ?>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_pemesanan" value="<?php echo $pemesanan['id_pemesanan']; ?>">
                                        <input type="hidden" name="status" value="2">
                                        <?php if ($pemesanan['status'] == 1) { ?>
                                            <button type="submit" class="btn btn-primary btn-sm" name="konfirmasi">Konfirmasi</button>
                                        <?php } else { ?>
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-warning btn-sm" name="batal">Batalkan</button>
                                        <?php } ?>
                                        <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $pemesanan['id_pemesanan']; ?>">Hapus</button> -->
                                        <a data-toggle="modal" data-target="#modal-hapus<?= $pemesanan['id_pemesanan']; ?>"  class="btn btn-danger btn-sm">Hapus</a>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal image -->
        <div class="modal fade" id="modal-img">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <!-- <h4 class="modal-title">Hapus Data Bukti</h4> -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <img src="../assets/img/<?= $pemesanan['bukti']; ?>" class="modal-img">
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Akhir Modal Image -->

        <!-- Modal Hapus -->
        <?php foreach ($data_pemesanan as $pemesanan) : ?>
            <div class="modal fade" id="modal-hapus<?= $pemesanan['id_pemesanan']; ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Hapus Data Bukti</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p>
                                <!-- Nama Kamar: <b><?= $pemesanan['nama_kamar']; ?></b>
                                <br>Jumlah Kasur: <b><?= $pemesanan['jumlah_kasur']; ?></b> -->
                                Nama Pemesan: <b><?= $pemesanan['nama_pemesan']; ?></b>
                                <br>
                                Bukti: <b><img src="../assets/img/<?= $pemesanan['bukti']; ?>" width="100px" alt=""></b>
                                <br><br>
                                <b>Yakin Ingin Menghapus?</b>
                            </p>
                            <form action="" method="post">

                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    <a href="hapus_pemesanan.php?id_pemesanan=<?= $pemesanan['id_pemesanan']; ?>" class="btn btn-danger">Hapus</a>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- Akhir Modal Hapus-->
    </div>
</div>



<?php
include '../layouts/footer_resepsionis.php';
?>