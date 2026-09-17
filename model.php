<?php
require_once 'koneksi.php';

function getSemuaMurid() {
    global $koneksi;
    $query = "SELECT * FROM murid";
    $hasil = mysqli_query($koneksi, $query);
    $data = [];
    if ($hasil) { while ($baris = mysqli_fetch_assoc($hasil)) { $data[] = $baris; } }
    return $data;
}

function getSemuaLog() {
    global $koneksi;
    $query = "SELECT * FROM log_absensi ORDER BY waktu_simpan DESC";
    $hasil = mysqli_query($koneksi, $query);
    $data = [];
    if ($hasil) { while ($baris = mysqli_fetch_assoc($hasil)) { $data[] = $baris; } }
    return $data;
}

function simpanAbsensiLengkap($mapel, $kelas, $guru, $bulan, $data_kehadiran_array) {
    global $koneksi;
    
    $mapel = mysqli_real_escape_string($koneksi, $mapel);
    $kelas = mysqli_real_escape_string($koneksi, $kelas);
    $guru = mysqli_real_escape_string($koneksi, $guru);
    $bulan = mysqli_real_escape_string($koneksi, $bulan);
    
    $query_log = "INSERT INTO log_absensi (mata_pelajaran, kelas, nama_guru, bulan) VALUES ('$mapel', '$kelas', '$guru', '$bulan')";
    mysqli_query($koneksi, $query_log);
    
    $id_log = mysqli_insert_id($koneksi);
    
    if ($id_log > 0 && !empty($data_kehadiran_array)) {
        foreach ($data_kehadiran_array as $id_murid => $tanggal_data) {
            foreach ($tanggal_data as $tanggal => $status) {
                $id_m = (int)$id_murid;
                $tgl = (int)$tanggal;
                $st = mysqli_real_escape_string($koneksi, $status);
                
                if($st != "") {
                    $q_hadir = "INSERT INTO data_kehadiran (id_log, id_murid, tanggal, status_kehadiran) VALUES ($id_log, $id_m, $tgl, '$st')";
                    mysqli_query($koneksi, $q_hadir);
                }
            }
        }
    }
}
?>