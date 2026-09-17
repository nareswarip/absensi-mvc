<?php
require_once 'model.php';

if (isset($_POST['btn_simpan'])) {
    $mapel = $_POST['mapel'];
    $kelas = $_POST['kelas'];
    $guru  = $_POST['guru'];
    $bulan = $_POST['bulan'];
    
    $data_kehadiran = isset($_POST['kehadiran']) ? $_POST['kehadiran'] : [];
    
    simpanAbsensiLengkap($mapel, $kelas, $guru, $bulan, $data_kehadiran);
    
    header("Location: index.php");
    exit;
}

$data_murid_dari_controller = getSemuaMurid();
$data_log_dari_controller = getSemuaLog();

require_once 'view.php';
?>