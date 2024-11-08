<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../koneksi.php';

// membuat variabel untuk menampung data dari form
$id_rumah = $_POST['id_rumah'];
$gambar = $_FILES['gambar']['name'];
$tipe = $_POST['tipe'];
$luas_tanah = $_POST['luas_tanah'];
$luas_bangunan = $_POST['luas_bangunan'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];

//cek dulu jika merubah gambar jalankan coding ini
if ($gambar != "") {
  $ekstensi_diperbolehkan = array('png', 'jpg'); //ekstensi file gambar yang bisa diupload 
  $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];
  $angka_acak = rand(1, 999);
  $nama_gambar_baru = $angka_acak . '-' . $gambar; //menggabungkan angka acak dengan nama file sebenarnya
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //memindah file gambar ke folder gambar

    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
    $query = "UPDATE unit_rumah SET tipe = '$tipe', luas_tanah = '$luas_tanah', luas_bangunan = '$luas_bangunan', deskripsi = '$deskripsi', harga = '$harga', gambar = '$nama_gambar_baru'";
    $query .= "WHERE id_rumah = '$id_rumah'";
    $result = mysqli_query($koneksi, $query);
    // periska query apakah ada error
    if (!$result) {
      die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
    } else {
      //tampil alert dan akan redirect ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil diubah.');window.location='../crud_unit.php';</script>";
    }
  } else {
    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit_unit.php';</script>";
  }
} else {
  // jalankan query UPDATE berdasarkan ID yang produknya kita edit
  $query = "UPDATE unit_rumah SET tipe = '$tipe', luas_tanah = '$luas_tanah', luas_bangunan = '$luas_bangunan', deskripsi = '$deskripsi', harga = '$harga'";
  $query .= "WHERE id_rumah = '$id_rumah'";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='../crud_unit.php';</script>";
  }
}