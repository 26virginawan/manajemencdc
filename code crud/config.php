<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'dbcdc';
$connect = mysqli_connect($host, $user, $pass, $database);
// script cek koneksi
if (!$connect) {
    die('Koneksi Tidak Berhasil: ' . mysqli_connect_error());
}
?>