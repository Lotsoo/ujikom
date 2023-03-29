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

$data_kamar = select("SELECT * FROM kamar");
if (isset($_POST['tambah'])) {
    if (create_kamar($_POST) > 0) {
        echo "
       <script>
       alert('Data Kamar Berhasil Ditambahkan');
       document.location.href='kamar.php';
       </script>
       ";
    } else {
        echo "
       <script>
       alert('Data Kamar Gagal Ditambahkan');
       document.location.href='kamar.php';
       </script>
       ";
    }
}

if (isset($_POST['ubah'])) {
    if (update_kamar($_POST) > 0) {
        echo "
       <script>
       alert('Data Kamar Berhasil Diubah');
       document.location.href='kamar.php';
       </script>
       ";
    } else {
        echo "
       <script>
       alert('Data Kamar Gagal Diubah');
       document.location.href='kamar.php';
       </script>
       ";
    }
}
?>

<div class="">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Kamar Hotel</h3>
                <br><br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                    Tambah
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe Kamar</th>
                            <th>Jumlah Kamar</th>
                            <th>Jumlah Kasur</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;;
                        foreach ($data_kamar as $kamar) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $kamar['tipe_kamar']; ?></td>
                                <td><?= $kamar['jumlah_kamar']; ?></td>
                                <td><?= $kamar['jumlah_kasur']; ?></td>
                                <td><?= number_format($kamar['harga'],0,'.','.'); ?></td>
                                <td width="10%">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-ubah<?= $kamar['id_kamar']; ?>">Ubah</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $kamar['id_kamar']; ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modal-tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Tambah Data Kamar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="tipe_kamar">Tipe Kamar</label>
                                <input type="text" id="tipe_kamar" name="tipe_kamar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_kamar">Jumlah Kamar</label>
                                <input type="number" id="jumlah_kamar" name="jumlah_kamar" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_kasur">Jumlah Kasur</label>
                                <input type="number" id="jumlah_kasur" name="jumlah_kasur" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" id="harga" name="harga" class="form-control" required>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                <button type="submit"  name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Akhir Modal Tambah -->

        <!-- Modal Ubah -->
        <?php foreach ($data_kamar as $kamar) : ?>
            <div class="modal fade" id="modal-ubah<?= $kamar['id_kamar']; ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Ubah Data Kamar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post">
                                <input type="hidden" name="id_kamar" value="<?= $kamar['id_kamar']; ?>">
                                <div class="mb-3">
                                    <label for="tipe_kamar">Tipe Kamar</label>
                                    <input type="text" id="tipe_kamar" name="tipe_kamar" class="form-control" value="<?= $kamar['tipe_kamar']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_kamar">Jumlah Kamar</label>
                                    <input type="number" id="jumlah_kamar" name="jumlah_kamar" class="form-control" value="<?= $kamar['jumlah_kamar']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_kasur">Jumlah Kasur</label>
                                    <input type="number" id="jumlah_kasur" name="jumlah_kasur" class="form-control" value="<?= $kamar['jumlah_kasur']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga">Harga</label>
                                    <input type="number" id="harga" name="harga" class="form-control" value="<?= $kamar['harga']; ?>" required>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php endforeach; ?>
        <!-- Akhir Modal Ubah-->

        <!-- Modal Hapus -->
        <?php foreach ($data_kamar as $kamar) : ?>
            <div class="modal fade" id="modal-hapus<?= $kamar['id_kamar']; ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title">Hapus Data Kamar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <p>
                                tipe Kamar: <b><?= $kamar['tipe_kamar']; ?></b>
                                <br>Jumlah Kamar: <b><?= $kamar['jumlah_kamar']; ?></b>
                                <br>Jumlah Kasur: <b><?= $kamar['jumlah_kasur']; ?></b>
                                <br>Harga: <b><?= $kamar['harga']; ?></b>
                                <br><br><b>Yakin Ingin Menghapus?</b>
                            </p>
                            <form action="" method="post">

                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    <a href="hapus_kamar.php?id_kamar=<?= $kamar['id_kamar']; ?>" class="btn btn-danger">Hapus</a>
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
include '../layouts/footer_admin.php';
?>