<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Hadir Murid</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8f9fa; padding: 20px; color: #333; font-size: 13px; }
        .container { background-color: white; padding: 20px; border-top: 4px solid #030504; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .form-area { text-align: left; margin-bottom: 20px; display: flex; flex-direction: column; gap: 8px; }
        .form-area h2 { color: #059669; margin: 0 0 10px 0; font-size: 18px; }
        .baris-input { display: flex; align-items: center; }
        .baris-input label { font-weight: 600; width: 110px; }
        .baris-input input { padding: 4px 8px; border: 1px solid #ccc; border-radius: 3px; font-size: 12px; width: 180px; outline: none; }
        .baris-input input:focus { border-color: #059669; }
        .btn-submit { background-color: #059669; color: white; border: none; padding: 8px 16px; font-size: 13px; font-weight: bold; border-radius: 3px; cursor: pointer; width: 100px; margin-top: 10px; }
        .btn-submit:hover { background-color: #047857; }
        .table-area { overflow-x: auto; }
        table { border-collapse: collapse; width: max-content; }
        .tabel-log { width: 100%; }
        th, td { border: 1px solid #e5e7eb; padding: 5px 8px; text-align: center; }
        th { background-color: #059669; color: white; font-weight: 500; }
        .tabel-utama td:nth-child(2) { text-align: left; white-space: nowrap; font-weight: 500; }
        select { padding: 2px 4px; border: 1px solid #d1d5db; font-size: 12px; border-radius: 2px; outline: none; }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
            <div class="form-area">
                <h2>Daftar Hadir Murid</h2>
                <div class="baris-input">
                    <label>Mata Pelajaran</label> <input type="text" name="mapel" required>
                </div>
                <div class="baris-input">
                    <label>Kelas</label> <input type="text" name="kelas" required>
                </div>
                <div class="baris-input">
                    <label>Nama Guru</label> <input type="text" name="guru" required>
                </div>
                <div class="baris-input">
                    <label>Bulan</label> <input type="date" name="bulan" required>
                </div>
                <button type="submit" name="btn_simpan" class="btn-submit">Simpan</button>
            </div>

            <div class="table-area">
                <table class="tabel-utama">
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Nama Murid</th>
                            <th colspan="30">Tanggal</th>
                        </tr>
                        <tr>
                            <?php for($i=1; $i<=30; $i++) { echo "<th>$i</th>"; } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (!empty($data_murid_dari_controller)) {
                            foreach ($data_murid_dari_controller as $murid) { 
                                $id_m = $murid['id'];
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($murid['nama_murid']); ?></td>
                            
                            <?php for($i=1; $i<=30; $i++) { ?>
                            <td>
                                <select name="kehadiran[<?= $id_m; ?>][<?= $i; ?>]">
                                    <option value="" selected disabled hidden>-</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                    <option value="Alpha">Alpha</option>
                                </select>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php 
                            } 
                        } else {
                            echo "<tr><td colspan='32'>Data tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <div class="container">
        <h2 style="color: #059669; margin: 0 0 10px 0; font-size: 18px;">Riwayat Penyimpanan</h2>
        <div class="table-area">
            <table class="tabel-log">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Bulan</th>
                        <th>Status Data Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no_log = 1;
                    if (!empty($data_log_dari_controller)) {
                        foreach ($data_log_dari_controller as $log) {
                    ?>
                    <tr>
                        <td><?= $no_log++; ?></td>
                        <td><?= htmlspecialchars($log['waktu_simpan']); ?></td>
                        <td><?= htmlspecialchars($log['mata_pelajaran']); ?></td>
                        <td><?= htmlspecialchars($log['kelas']); ?></td>
                        <td><?= htmlspecialchars($log['nama_guru']); ?></td>
                        <td><?= htmlspecialchars($log['bulan']); ?></td>
                        <td><strong>Tersimpan di tabel `data_kehadiran` (Linked by ID Log: <?= $log['id']; ?>)</strong></td>
                    </tr>
                    <?php 
                        }
                    } else {
                        echo "<tr><td colspan='7'>Belum ada riwayat.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>