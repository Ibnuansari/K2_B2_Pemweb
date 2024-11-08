<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../koneksi.php';

date_default_timezone_set('Asia/Makassar');

// membuat variabel untuk menampung data dari form
$nama = $_POST['nama'];
$ponsel = $_POST['ponsel'];
$email = $_POST['email'];
$perihal = $_POST['perihal'];
$pesan = $_POST['pesan'];

// jalankan query INSERT untuk menambah data ke database
$query = "INSERT INTO pesan (nama, ponsel, email, perihal, pesan) VALUES ('$nama', '$ponsel', '$email', '$perihal', '$pesan')";
    $result = mysqli_query($koneksi, $query);

    // periksa query apakah ada error
    if(!$result) {
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    } else {
        // tampilkan alert dan redirect ke halaman index.php
        echo "<script>alert('Berhasil Mengirim Pesan.');window.location='../index.php';</script>";
    }

    // periksa query apakah ada error
    if(!$result) {
        die ("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
    } else {
        // tampilkan alert dan redirect ke halaman index.php
        echo "<script>alert('Berhasil Mengirim Pesan.');window.location='../index.php';</script>";
    }
?>