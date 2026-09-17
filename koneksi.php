<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "lsp_absensi";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Database gagal: " . mysqli_connect_error());
}
?>