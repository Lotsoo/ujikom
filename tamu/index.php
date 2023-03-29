<?php
include '../config/app.php';
session_start();

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
} else if ($_SESSION['level'] == 'resepsionis') {
    echo "<script>alert('Maaf, Anda Tidak Punya Hak Akses!');
    document.location.href='../resepsionis/index.php';
    </script>";
    exit;
}

// if($_SESSION['level'] == 'admin'){
//     echo "<script>alert('Maaf, Login Hanya Bisa Sekali!');
//     document.location.href='admin/index.php';
//     </script>"; 
//     exit;
// } else if($_SESSION['level'] == 'resepsionis'){
//     echo "<script>alert('Maaf, Login Hanya Bisa Sekali!');
//     document.location.href='resepsionis/index.php';
//     </script>"; 
//     exit;
// } else if($_SESSION['level'] == 'tamu'){
//     echo "<script>alert('Maaf, Login Hanya Bisa Sekali!');
//     document.location.href='tamu/index.php';
//     </script>"; 
//     exit;
// }

if (isset($_POST['pesan'])) {
    if (pesan_kamar($_POST) > 0) {
        echo "<script>
        alert('Pesan Kamar Berhasil Ditambahkan');
        document.location.href = 'pemesanan.php';
        </script>";
    } else {
        echo "<script>
        alert('Pesan Kamar Gagal Ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}

?>

<!doctype html>
<html class="no-js" lang="eng" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hotel Hebat</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="../template/css/bootstrap.min.css">
    <link rel="stylesheet" href="../template/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../template/css/magnific-popup.css">
    <link rel="stylesheet" href="../template/css/font-awesome.min.css">
    <link rel="stylesheet" href="../template/css/themify-icons.css">
    <link rel="stylesheet" href="../template/css/nice-select.css">
    <link rel="stylesheet" href="../template/css/flaticon.css">
    <link rel="stylesheet" href="../template/css/gijgo.css">
    <link rel="stylesheet" href="../template/css/animate.css">
    <link rel="stylesheet" href="../template/css/slicknav.css">
    <link rel="stylesheet" href="../template/css/style.css">
    <!-- <link rel="stylesheet" href="../template/css/responsive.css"> -->
</head>

<body id="home">
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid p-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-xl-5 col-lg-6">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="active" href="#home">Home</a></li>
                                        <li><a href="#about">Tentang Kami</a></li>
                                        <li><a href="pemesanan.php">Pemesanan</a></li>
                                        <li><a href="../login/logout.php">Logout</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2">
                        </div>
                        <div class="col-xl-5 col-lg-4 d-none d-lg-block">
                            <div class="book_room">
                                <div class="book_btn d-none d-lg-block">
                                    <a class="popup-with-form" href="#test-form">Pesan Kamar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->



    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>Hotel Hebat</h3>
                                <!-- <p>Unlock to enjoy the view of Martine</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center justify-content-center slider_bg_2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider_text text-center">
                                <h3>Hidup itu Indah</h3>
                                <!-- <p>Unlock to enjoy the view of Martine</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- about_area_start -->
    <div class="about_area" id="about">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5">
                    <div class="about_info">
                        <div class="section_title mb-20px">
                            <span>Tentang Kami</span>
                            <h3>Hotel Hebat</h3>
                        </div>
                        <p>Lepaskan diri Anda ke Hotel Hebat. Dikelilingi oleh keindahan pegunungan yang indah, danau, dan sawah menghijau. Nikmati sore yang hangat dan berenang di kolam renang dengan pemandangan matahari terbenam yang memukau. Kid's Club yang luas menawarkan beragam fasilitas dan kegiatan anak-anak yang akan melengkapi kenyamanan keluarga. Convention Center kami, dilengkapi pelayanan lengkap dengan ruang konvensi terbesar di Bandung. Mampu mengakomodasi hingga 3.000 delegasi. Manfaatkan ruang penyelanggaraan konvensi M.I.C.E ataupun mewujudkan acara pernikahan adat yang mewah.</p>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7">
                    <div class="about_thumb d-flex">
                        <div class="img_1">
                            <img src="../template/img/about/about_1.png" alt="">
                        </div>
                        <div class="img_2">
                            <img src="../template/img/about/about_2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about_area_end -->

    <!-- features_room_startt -->
    <div class="features_room" id="kamar">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-100">
                        <h3>Kamar Hotel Hebat</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="rooms_here">
            <div class="single_rooms">
                <div class="room_thumb">
                    <img src="../template/img/rooms/1.png" alt="">
                    <div class="room_heading d-flex justify-content-between align-items-center">
                        <div class="room_heading_inner">
                            <span>Mulai dari Rp. 100.000/malam</span>
                            <h3>Kamar Superior</h3>
                        </div>
                        <a href="#" class="line-button">pesan sekarang</a>
                    </div>
                </div>
            </div>
            <div class="single_rooms">
                <div class="room_thumb">
                    <img src="../template/img/rooms/2.png" alt="">
                    <div class="room_heading d-flex justify-content-between align-items-center">
                        <div class="room_heading_inner">
                            <span>Mulai dari Rp. 200.000/malam</span>
                            <h3>Kamar Deluxe</h3>
                        </div>
                        <a href="#" class="line-button">pesan sekarang</a>
                    </div>
                </div>
            </div>
            <div class="single_rooms">
                <div class="room_thumb">
                    <img src="../template/img/rooms/3.png" alt="">
                    <div class="room_heading d-flex justify-content-between align-items-center">
                        <div class="room_heading_inner">
                            <span>Mulai dari Rp. 300.000/malam</span>
                            <h3>Kamar Keluarga</h3>
                        </div>
                        <a href="#" class="line-button">pesan sekarang</a>
                    </div>
                </div>
            </div>
            <div class="single_rooms">
                <div class="room_thumb">
                    <img src="../template/img/rooms/4.png" alt="">
                    <div class="room_heading d-flex justify-content-between align-items-center">
                        <div class="room_heading_inner">
                            <span>Mulai dari Rp. 200.000/malam</span>
                            <h3>Kamar Pasangan</h3>
                        </div>
                        <a href="#" class="line-button">pesan sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- features_room_end -->

    <!-- footer -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Alamat
                            </h3>
                            <p class="footer_text"> Jl. Kita Msh Panjang, <br>Tajurhalang, Kec. Tajur Halang, Kabupaten Bogor, Jawa Barat 16320</p>
                            <a href="https://www.google.com/maps/place/Jl.+Kita+Msh+Panjang,+Tajurhalang,+Kec.+Tajur+Halang,+Kabupaten+Bogor,+Jawa+Barat+16320/data=!4m2!3m1!1s0x2e69c2975efc0ea7:0x696f7347d545ada5?sa=X&ved=2ahUKEwjO6P3S2M39AhW1T2wGHXjFCRYQ8gF6BAhFEAE" target="_blank" class="line-button">Lokasi Lebih Lanjut</a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Pemesanan
                            </h3>
                            <p class="footer_text">+62 812 3456 7890 <br>
                                hotelhebat@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Navigasi
                            </h3>
                            <ul>
                                <li><a href="#home">Home</a></li>
                                <li><a href="#about">Tentang Kami</a></li>
                                <li><a href="pemesanan.php">Pemesanan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-8 col-md-7 col-lg-9">
                        <p class="copy_right">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved <a href="www.github.com/lotsoo">Lotso</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- link that opens popup -->



    <!-- form itself end-->
    <form id="test-form" class="white-popup-block mfp-hide" method="post">
        <div class="popup_box ">
            <div class="popup_inner">
                <h3>Pesan Kamar</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-xl-6">
                            <input id="datepicker" placeholder="Check in date" name="check_in">
                        </div>
                        <div class="col-xl-6">
                            <input id="datepicker2" placeholder="Check out date" name="check_out">
                        </div>
                        <div class="col-xl-12">
                            <input type="text" class="form-control" placeholder="Nama Pemesan" name="nama_pemesan">
                            <br>
                        </div>
                        <div class="col-xl-12">
                            <input type="number" class="form-control" placeholder="No. Handphone" name="nomor_hp">
                            <br>
                        </div>
                        <div class="col-xl-12">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <br>
                        </div>
                        <div class="col-xl-12">
                            <input type="text" class="form-control" placeholder="Nama Tamu" name="nama_tamu">
                            <br>
                        </div>
                        <div class="col-xl-12">
                            <input type="number" class="form-control" placeholder="Jumlah Kamar" name="jumlah_kamar">
                            <br>
                        </div>
                        <div class="col-xl-12">
                            <select class="form-select wide" id="default-select" class="" name="tipe_kamar">
                                <option data-display="Tipe Kamar">Tipe Kamar</option>
                                <option value="Kamar Deluxe">Kamar Deluxe</option>
                                <option value="Kamar Superior">Kamar Superior</option>
                                <option value="Kamar Keluarga">Kamar Keluarga</option>
                                <option value="Kamar Pasangan">Kamar Pasangan</option>
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" name="pesan" class="boxed-btn3">Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
    <!-- form itself end -->

    <!-- JS here -->
    <script src="../template/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="../template/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../template/js/popper.min.js"></script>
    <script src="../template/js/bootstrap.min.js"></script>
    <script src="../template/js/owl.carousel.min.js"></script>
    <script src="../template/js/isotope.pkgd.min.js"></script>
    <script src="../template/js/ajax-form.js"></script>
    <script src="../template/js/waypoints.min.js"></script>
    <script src="../template/js/jquery.counterup.min.js"></script>
    <script src="../template/js/imagesloaded.pkgd.min.js"></script>
    <script src="../template/js/scrollIt.js"></script>
    <script src="../template/js/jquery.scrollUp.min.js"></script>
    <script src="../template/js/wow.min.js"></script>
    <script src="../template/js/nice-select.min.js"></script>
    <script src="../template/js/jquery.slicknav.min.js"></script>
    <script src="../template/js/jquery.magnific-popup.min.js"></script>
    <script src="../template/js/plugins.js"></script>
    <script src="../template/js/gijgo.min.js"></script>

    <!--contact js-->
    <script src="../template/js/contact.js"></script>
    <script src="../template/js/jquery.ajaxchimp.min.js"></script>
    <script src="../template/js/jquery.form.js"></script>
    <script src="../template/js/jquery.validate.min.js"></script>
    <script src="../template/js/mail-script.js"></script>

    <script src="../template/js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
    </script>



</body>

</html>