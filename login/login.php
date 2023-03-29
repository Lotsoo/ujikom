<?php
// if($_SESSION['level'] == 'admin'){
//     echo "<script>alert('Maaf, Anda Sudah Login!');
//     document.location.href='../admin/index.php';
//     </script>"; 
//     exit;
// } else if($_SESSION['level'] == 'resepsionis'){
//     echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
//     document.location.href='../resepsionis/index.php';
//     </script>"; 
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../assets/index2.html">Hotel Hebat</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in dengan Username & Password</p>
                <?php include 'cek_login.php'; if (isset($error)) : ?>
                    <div class="alert alert-danger text-center">
                        <b>Username/Password SALAH</b>
                    </div>
                <?php endif; ?>

                <form action="cek_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="../index.php" class="btn btn-danger btn-block">Kembali</a>
                        </div>

                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
                            <!-- <button hidden name="admin">admin</button>
                            <button hidden name="resepsionis">resepsionis</button> -->
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>