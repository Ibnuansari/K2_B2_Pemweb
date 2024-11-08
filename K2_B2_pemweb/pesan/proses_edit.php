<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../koneksi.php';

// membuat variabel untuk menampung data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$ponsel = $_POST['ponsel'];
$email = $_POST['email'];
$perihal = $_POST['perihal'];
$pesan = $_POST['pesan'];

// jalankan query UPDATE berdasarkan ID yang datanya ingin kita edit
$query  = "UPDATE pesan SET nama = '$nama', ponsel = '$ponsel', email = '$email', perihal = '$perihal', pesan = '$pesan' ";
$query .= "WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);

// periksa query apakah ada error
if(!$result){
    die("Query gagal dijalankan: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
} else {
    // tampilkan alert dan redirect ke halaman crud_pesan.php
    // silakan ganti crud_pesan.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='../crud_pesan.php';</script>";
}
?>
