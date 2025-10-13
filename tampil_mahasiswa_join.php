<?php
// File: tampil_mahasiswa_join.php
require_once 'Database.php';

try {
    $db = Database::getInstance();
    
    // Ambil data jurusan untuk dropdown
    $stmtJurusan = $db->query("SELECT * FROM jurusan ORDER BY nama_jurusan");
    $daftarJurusan = $stmtJurusan->fetchAll(PDO::FETCH_ASSOC);
    
    // Handle filter dan sorting
    $jurusanFilter = $_GET['jurusan'] ?? '';
    $sortBy = $_GET['sort_by'] ?? 'nama';
    $sortOrder = $_GET['sort_order'] ?? 'ASC';
    
    // Validasi input
    $allowedColumns = ['nim', 'nama', 'nama_jurusan'];
    $allowedOrders = ['ASC', 'DESC'];
    
    if (!in_array($sortBy, $allowedColumns)) $sortBy = 'nama';
    if (!in_array($sortOrder, $allowedOrders)) $sortOrder = 'ASC';
    
    // Build query
    $sql = "SELECT m.nim, m.nama, j.nama_jurusan 
            FROM mahasiswa m 
            LEFT JOIN jurusan j ON m.jurusan = j.id";
    
    $params = [];
    
    // Filter jurusan
    if (!empty($jurusanFilter) && is_numeric($jurusanFilter)) {
        $sql .= " WHERE m.jurusan = :jurusan";
        $params[':jurusan'] = $jurusanFilter;
    }
    
    // Sorting
    $sql .= " ORDER BY $sortBy $sortOrder";
    
    // Execute query
    $stmt = $db->prepare($sql);
    if (!empty($params)) {
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value, PDO::PARAM_INT);
        }
    }
    $stmt->execute();
    $dataMahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    $error = "Error: " . $e->getMessage();
    $dataMahasiswa = [];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .filter-form { background: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .form-group { margin-bottom: 10px; }
        label { display: inline-block; width: 150px; font-weight: bold; }
        select, button { padding: 8px 12px; margin-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #343a40; color: white; }
        .no-data { text-align: center; padding: 40px; color: #6c757d; font-size: 18px; }
        .btn { background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Mahasiswa</h1>
        
        <!-- Form Filter -->
        <div class="filter-form">
            <form method="GET" action="">
                <div class="form-group">
                    <label for="jurusan">Filter Jurusan:</label>
                    <select name="jurusan" id="jurusan">
                        <option value="">-- Semua Jurusan --</option>
                        <?php foreach ($daftarJurusan as $jurusan): ?>
                            <option value="<?= $jurusan['id'] ?>" 
                                <?= ($jurusanFilter == $jurusan['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($jurusan['nama_jurusan']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="sort_by">Urutkan By:</label>
                    <select name="sort_by" id="sort_by">
                        <option value="nama" <?= ($sortBy == 'nama') ? 'selected' : '' ?>>Nama</option>
                        <option value="nim" <?= ($sortBy == 'nim') ? 'selected' : '' ?>>NIM</option>
                        <option value="nama_jurusan" <?= ($sortBy == 'nama_jurusan') ? 'selected' : '' ?>>Jurusan</option>
                    </select>
                    
                    <select name="sort_order" id="sort_order">
                        <option value="ASC" <?= ($sortOrder == 'ASC') ? 'selected' : '' ?>>ASC</option>
                        <option value="DESC" <?= ($sortOrder == 'DESC') ? 'selected' : '' ?>>DESC</option>
                    </select>
                </div>
                
                <button type="submit" class="btn">Terapkan Filter</button>
                <button type="button" class="btn" onclick="window.location.href='tampil_mahasiswa_join.php'">Reset</button>
            </form>
        </div>

        <!-- Tabel Data -->
        <?php if (isset($error)): ?>
            <div style="color: red; padding: 10px; background: #f8d7da;"><?= $error ?></div>
        <?php elseif (empty($dataMahasiswa)): ?>
            <div class="no-data">
                <h3>Tidak ada data mahasiswa yang ditemukan</h3>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataMahasiswa as $mhs): ?>
                        <tr>
                            <td><?= htmlspecialchars($mhs['nim']) ?></td>
                            <td><?= htmlspecialchars($mhs['nama']) ?></td>
                            <td><?= htmlspecialchars($mhs['nama_jurusan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Total: <?= count($dataMahasiswa) ?> mahasiswa</p>
        <?php endif; ?>
    </div>
</body>
</html>