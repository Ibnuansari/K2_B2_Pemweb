<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "crud_rumah";

$koneksi = mysqli_connect($host ,$user ,$password ,$db);
if (!$koneksi){
    die("Koneksi Gagal:".mysqli_connect_error());
}
?>
