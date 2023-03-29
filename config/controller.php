<?php

// membuat function select, untuk menarik data
function select($query)
{
    // memanggil variable koneksi
    global $koneksi;

    // menangkap query yg ada di parameter
    $result = mysqli_query($koneksi, $query);
    $rows = [];

    // membuat perulangan, lalu menangkap data dengan associative
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// membuat function pesan_kamar, agar user dapat memesan kamar hotel 
function pesan_kamar($post)
{
    // memanggil variable koneksi
    global $koneksi;

    // mendeklarasikan variable lalu menangkap data yg ada di form
    $nama_pemesan = $post['nama_pemesan'];
    $nomor_hp = $post['nomor_hp'];
    $email = $post['email'];
    $nama_tamu = $post['nama_tamu'];
    $check_in = $post['check_in'];
    $check_out = $post['check_out'];
    $jumlah_kamar = $post['jumlah_kamar'];
    $tipe_kamar = $post['tipe_kamar'];

    // membuat query sql
    mysqli_query($koneksi, "INSERT INTO pemesanan VALUES(null, '$nama_pemesan', '$nomor_hp', '$email', '$nama_tamu', '$check_in', '$check_out', '$jumlah_kamar', '$tipe_kamar','1','1')");

    // mengembalikan jumlah baris yg sudah terkena query sql
    return mysqli_affected_rows($koneksi);
}

function konfirmasi($post)
{
    global $koneksi;

    $id_pemesanan = $post['id_pemesanan'];
    $status = $post['status'];

    $query = "UPDATE pemesanan SET id_pemesanan = '$id_pemesanan', status = '$status' WHERE id_pemesanan = '$id_pemesanan'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function batal_konfirmasi($post)
{
    global $koneksi;

    $id_pemesanan = $post['id_pemesanan'];
    $status = $post['status'];

    $query = "UPDATE pemesanan SET id_pemesanan = '$id_pemesanan', status = '$status' WHERE id_pemesanan = '$id_pemesanan'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function kirim_bukti_transaksi($post)
{
    global $koneksi;

    $id_pemesanan = $post['id_pemesanan'];

    $bukti = $_FILES['bukti']['name'];

    if ($bukti != '') {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
        $pisah_ekstensi_file = explode('.', $bukti);
        $ekstensi = strtolower(end($pisah_ekstensi_file));
        $file_tmp = $_FILES['bukti']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $bukti;
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, '../assets/img/' . $nama_gambar_baru);
            $sql = "UPDATE pemesanan SET bukti = '$nama_gambar_baru' WHERE id_pemesanan = '$id_pemesanan'";
            $result = mysqli_query($koneksi, $sql);

            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . mysqli_error($koneksi));
            } else {
                echo "<script>
					alert('Data Berhasil diubah');window.location='../tamu/pemesanan.php';
					</script>";
            }
        } else {
            echo "<script>
				alert('Ekstensi gambar harus png, jpg atau jpeg.');window.location='../tamu/pemesanan.p hp';
				</script>";
        }
    }
}

function delete_bukti($id_pemesanan)
{
    global $koneksi;

    // ambil foto sesuai data yang dipilih
    $bukti = select("SELECT * FROM pemesanan WHERE id_pemesanan = $id_pemesanan")[0];
    unlink("../assets/img/". $bukti['bukti']);

    // query hapus data pemesanan
    $query = "DELETE FROM pemesanan WHERE id_pemesanan = $id_pemesanan";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function create_kamar($post)
{
    global $koneksi;
    $tipe_kamar = $post['tipe_kamar'];
    $jumlah_kamar = $post['jumlah_kamar'];
    $jumlah_kasur = $post['jumlah_kasur'];
    $harga = $post['harga'];

    mysqli_query($koneksi, "INSERT INTO kamar VALUES(null,'$tipe_kamar', '$jumlah_kamar', '$jumlah_kasur','$harga')");

    return mysqli_affected_rows($koneksi);
}

function update_kamar($post)
{
    global $koneksi;
    $id_kamar = $post['id_kamar'];
    $tipe_kamar = $post['tipe_kamar'];
    $jumlah_kamar = $post['jumlah_kamar'];
    $jumlah_kasur = $post['jumlah_kasur'];
    $harga = $post['harga'];

    mysqli_query($koneksi, "UPDATE kamar SET tipe_kamar='$tipe_kamar', jumlah_kamar='$jumlah_kamar', jumlah_kasur='$jumlah_kasur', harga='$harga' WHERE id_kamar='$id_kamar'");
    return mysqli_affected_rows($koneksi);
}

function delete_kamar($id_kamar)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar='$id_kamar'");
    return mysqli_affected_rows($koneksi);
}

function create_fasilitas($post)
{
    global $koneksi;
    $nama_fasilitas = $post['nama_fasilitas'];
    $ket_fasilitas = $post['ket_fasilitas'];

    mysqli_query($koneksi, "INSERT INTO fasilitas_kamar VALUES(null,'$nama_fasilitas', '$ket_fasilitas')");
    return mysqli_affected_rows($koneksi);
}

function update_fasilitas($post)
{
    global $koneksi;

    $id_fasilitas = $post['id_fasilitas'];
    $nama_fasilitas = $post['nama_fasilitas'];
    $ket_fasilitas = $post['ket_fasilitas'];

    mysqli_query($koneksi, "UPDATE fasilitas_kamar SET nama_fasilitas='$nama_fasilitas', ket_fasilitas='$ket_fasilitas' WHERE id_fasilitas='$id_fasilitas'");
    return mysqli_affected_rows($koneksi);
}

function delete_fasilitas($id_fasilitas)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM fasilitas_kamar WHERE id_fasilitas='$id_fasilitas'");
    return mysqli_affected_rows($koneksi);
}

function bulan()
{
    $bulan = date("F");

    switch ($bulan) {
        case 'January':
            $bulan = "Januari";
            break;

        case 'February':
            $bulan = "Februari";
            break;

        case 'March':
            $bulan = "Maret";
            break;

        case 'April':
            $bulan = "April";
            break;

        case 'May':
            $bulan = "Mei";
            break;

        case 'June':
            $bulan = "Juni";
            break;

        case 'July':
            $bulan = "Juni";
            break;

        case 'August':
            $bulan = "Agustus";
            break;

        case 'September':
            $bulan = "September";
            break;

        case 'October':
            $bulan = "Oktober";
            break;

        case 'November':
            $bulan = "November";
            break;

        case 'Desember':
            $bulan = "Desember";
            break;

        default:
            $bulan = "Tidak di ketahui";
            break;
    }

    return $bulan;
}
function hari()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;

        default:
            $hari_ini = "Tidak di ketahui";
            break;
    }

    return $hari_ini;
}
