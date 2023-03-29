<?php include '../layouts/header_tamu.php'; 

$data_pesanan = select("SELECT * FROM pemesanan WHERE id_pemesanan");

 if(isset($_POST['tambah']) && kirim_bukti_transaksi($_POST) > 0 ){

 }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pemesanan</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama Tamu</th>
                                    <th>Tanggal Check in</th>
                                    <th>Tanggal Check out</th>
                                    <th>Bukti Transaksi</th>
                                    <th>Status</th>
                                    <th>Kirim Bukti Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($data_pesanan as $pesanan) : ?>
                                <tr>
                                    <td><?= $no++ ;?></td>
                                    <td><?= $pesanan['nama_tamu']; ?></td>
                                    <td><?= $pesanan['check_in']; ?></td>
                                    <td><?= $pesanan['check_out']; ?></td>
                                    <td>
                                        <img src="../assets/img/<?php echo $pesanan['bukti'];?>"
                                            class="img-thumbnail" style="width: 150px;">
                                    </td>
                                    <td>
                                        <?php if($pesanan['status'] == 1){ ?>
                                        <span class=" badge bg-warning">Belum dikonfirmasi</span>
                                        <?php }else{ ?>
                                        <span class="badge bg-success">Sudah dikonfirmasi</span>
                                        <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if($pesanan['status']==1) { ?>
                                        <span class="btn btn-primary" data-toggle="modal"
                                            data-target="#konfirmasi<?= $pesanan['id_pemesanan'] ;?>">Kirim</span>
                                            <?php } else { ?>
                                                <span class="btn btn-success">Sukses</span>
                                                <?php }?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <?php foreach($data_pesanan as $pesanan) : ?>
                        <!-- Modal Konfirmasi Pemesanan -->
                        <div class="modal fade" id="konfirmasi<?= $pesanan['id_pemesanan'] ;?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Konfirmasi Pesanan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_pemesanan"
                                                value="<?php echo $pesanan['id_pemesanan'] ;?>">
                                            <div class="form-group">
                                                <label for="">No transaksi</label>
                                                <input type="text" class="form-control" placeholder="No Transaksi :  <?php echo $pesanan['id_pemesanan'] ;?>"
                                                    disabled>
                                            </div>
                                            <label for="file">Foto</label>
                                            <div class="form-group">
                                                <img src="../assets/img/<?php echo $pesanan['bukti']; ?>"
                                                    class="img-thumbnail my-1" style="width: 150px;">
                                                <input type="file" class="form-control-file" name="bukti">
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="tambah">Kirim</button>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                        <?php endforeach ;?>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->





<?php include '../layouts/footer_tamu.php'; ?>