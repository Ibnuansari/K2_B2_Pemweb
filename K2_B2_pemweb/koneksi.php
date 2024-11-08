<?php

$host = "sql212.infinityfree.com";
$user = "if0_37653651";
$password = "pO0n9IPjdTJYI";
$db = "if0_37653651_dbadshouse";

$koneksi = mysqli_connect($host ,$user ,$password ,$db);
if (!$koneksi){
    die("Koneksi Gagal:".mysqli_connect_error());
}
?>