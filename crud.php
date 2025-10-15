<?php
include 'ProgramStudi.php';

// Data sementara (simulasi database)
session_start();
if (!isset($_SESSION['data_prodi'])) {
    $_SESSION['data_prodi'] = [];
}

// CREATE
if (isset($_POST['tambah'])) {
    $p = new ProgramStudi(
        $_POST['id'],
        $_POST['prodi'],
        $_POST['kode_prodi'],
        $_POST['status'],
        $_POST['jenjang'],
        $_POST['kaprodi'],
        $_POST['fakultas']
    );
    $_SESSION['data_prodi'][] = $p;
}

// DELETE
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($_SESSION['data_prodi'][$index]);
    $_SESSION['data_prodi'] = array_values($_SESSION['data_prodi']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Program Studi</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
<h2>Form Tambah Program Studi</h2>
<form method="post">
    <label>ID:</label><br>
    <input type="text" name="id" required><br>
    <label>Prodi/Jurusan:</label><br>
    <input type="text" name="prodi" required><br>
    <label>Kode Prodi:</label><br>
    <input type="text" name="kode_prodi" required><br>
    <label>Status:</label><br>
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="tidak aktif">Tidak Aktif</option>
    </select><br>
    <label>Jenjang:</label><br>
    <input type="text" name="jenjang"><br>
    <label>Kaprodi:</label><br>
    <input type="text" name="kaprodi"><br>
    <label>Fakultas:</label><br>
    <input type="text" name="fakultas"><br><br>

    <button type="submit" name="tambah">Tambah</button>
</form>

<hr>

<h2>Daftar Program Studi</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Prodi</th>
        <th>Kode</th>
        <th>Status</th>
        <th>Jenjang</th>
        <th>Kaprodi</th>
        <th>Fakultas</th>
        <th>Aksi</th>
    </tr>
    <?php
    if (!empty($_SESSION['data_prodi'])) {
        foreach ($_SESSION['data_prodi'] as $index => $p) {
            echo "<tr>
                <td>{$p->id}</td>
                <td>{$p->prodi}</td>
                <td>{$p->kode_prodi}</td>
                <td>{$p->status}</td>
                <td>{$p->jenjang}</td>
                <td>{$p->kaprodi}</td>
                <td>{$p->fakultas}</td>
                <td><a href='?hapus=$index' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8' align='center'>Belum ada data</td></tr>";
    }
    ?>
</table>

</body>
</html>
