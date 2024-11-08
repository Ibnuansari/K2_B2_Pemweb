<?php 
include '../koneksi.php';
$id_rumah = $_GET["id_rumah"];
//mengambil id_rumah yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM unit_rumah WHERE id_rumah='$id_rumah' ";
    $hasil_query = mysqli_query($koneksi, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
        die ("Gagal menghapus data: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
    } else {
        echo "<script>alert('Data berhasil dihapus.');window.location='../crud_unit.php';</script>";
    }
