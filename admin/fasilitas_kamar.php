<?php
include '../layouts/header_admin.php';

if (!isset($_SESSION['login'])) {
  echo "<script>
  alert('Maaf, Untuk Mengakses Halaman Ini Anda Harus Login Terlebih Dahulu!');
  document.location.href='../login/login.php';</script>";
  exit;
}

$data_fasilitas = select("SELECT * FROM fasilitas_kamar");

if (isset($_POST['tambah'])) {
  if (create_fasilitas($_POST) > 0) {
    echo "<script>
    alert('Data Fasilitas Berhasil ditambahkan');
    document.location.href='fasilitas_kamar.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Kamar Berhasil ditambahkan');
    document.location.href='fasilitas_kamar.php';
    </script>";
  }
}
if (isset($_POST['ubah'])) {
  if (update_fasilitas($_POST) > 0) {
    echo "<script>
    alert('Data Fasilitas Berhasil diubah');
    document.location.href='fasilitas_kamar.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Kamar Berhasil diubah');
    document.location.href='fasilitas_kamar.php';
    </script>";
  }
}
?>

<div class="">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header">
        <h1 class="card-title">Data Fasilitas Kamar Hotel</h1>
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
              <th>Nama Fasilitas</th>
              <th>Keterangan Fasilitas</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;;
            foreach ($data_fasilitas as $fasilitas_kamar) :
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $fasilitas_kamar['nama_fasilitas']; ?></td>
                <td><?= $fasilitas_kamar['ket_fasilitas']; ?></td>
                <td width="10%">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-ubah<?= $fasilitas_kamar['id_fasilitas']; ?>">Ubah</button>
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $fasilitas_kamar['id_fasilitas']; ?>">Hapus</button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Data Fasilitas Kamar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="" method="post">
            <div class="mb-3">
              <label for="nama_fasilitas">Nama Fasilitas</label>
              <input type="text" id="nama_fasilitas" name="nama_fasilitas" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="ket_fasilitas">Keterangan Fasilitas</label>
              <input type="text" id="ket_fasilitas" name="ket_fasilitas" class="form-control" required>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
              <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
          </form>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Akhir Modal Tambah-->

  <!-- Modal Ubah -->
  <?php foreach($data_fasilitas as $fasilitas_kamar): ?>
  <div class="modal fade" id="modal-ubah<?= $fasilitas_kamar['id_fasilitas']; ?>">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title">Ubah Data Fasilitas Kamar</h4>
          <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="" method="post">
            <input type="hidden" name="id_fasilitas" value="<?= $fasilitas_kamar['id_fasilitas']; ?>">
            <div class="mb-3">
              <label for="nama_fasilitas">Nama Fasilitas</label>
              <input type="text" id="nama_fasilitas" name="nama_fasilitas" class="form-control" value="<?= $fasilitas_kamar['nama_fasilitas']; ?>" required>
            </div>
            <div class="mb-3">
              <label for="ket_fasilitas">Keterangan Fasilitas</label>
              <input type="text" id="ket_fasilitas" name="ket_fasilitas" class="form-control" value="<?= $fasilitas_kamar['ket_fasilitas']; ?>" required>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
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

  <!-- Modal hapus -->
  <?php foreach ($data_fasilitas as $fasilitas_kamar) : ?>
    <div class="modal fade" id="modal-hapus<?= $fasilitas_kamar['id_fasilitas']; ?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Hapus Data Fasilitas Kamar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              Nama Fasilitas: <b><?= $fasilitas_kamar['nama_fasilitas']; ?></b>
              <br>Keterangan Fasilitas: <b><?= $fasilitas_kamar['ket_fasilitas']; ?></b>
              <br><br><b>Yakin Ingin Menghapus? </b>
            </p>
            <form action="" method="post">

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                <a href="hapus_fasilitas_kamar.php?id_fasilitas=<?= $fasilitas_kamar['id_fasilitas']; ?>" class="btn btn-danger">Hapus</a>
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

<?php
include '../layouts/footer_admin.php';
?>