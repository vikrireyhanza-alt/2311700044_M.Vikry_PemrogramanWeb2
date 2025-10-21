<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Prodi</title>
</head>
<body>
    <h2>Data Program Studi</h2>
    <a href="tambah.php">+ Tambah Data</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Prodi/Jurusan</th>
            <th>Kode Prodi</th>
            <th>Status</th>
            <th>Jenjang</th>
            <th>Kaprodi</th>
            <th>Fakultas</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM prodi");
        while ($d = mysqli_fetch_array($data)) {
        ?>
        <tr>
            <td><?php echo $d['id']; ?></td>
            <td><?php echo $d['prodi_jurusan']; ?></td>
            <td><?php echo $d['kode_prodi']; ?></td>
            <td><?php echo $d['status']; ?></td>
            <td><?php echo $d['jenjang']; ?></td>
            <td><?php echo $d['kaprodi']; ?></td>
            <td><?php echo $d['fakultas']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
