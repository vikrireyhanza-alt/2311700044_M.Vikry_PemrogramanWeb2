<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Prodi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Tambah Data Program Studi</h2>

    <form method="post" action="">
        <label>Prodi/Jurusan:</label>
        <input type="text" name="prodi_jurusan" required>

        <label>Kode Prodi:</label>
        <input type="text" name="kode_prodi" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="">-- Pilih Status --</option>
            <option value="aktif">Aktif</option>
            <option value="tidak aktif">Tidak Aktif</option>
        </select>

        <label>Jenjang:</label>
        <input type="text" name="jenjang" placeholder="Contoh: S1, D3, S2" required>

        <label>Kaprodi:</label>
        <input type="text" name="kaprodi" required>

        <label>Fakultas:</label>
        <input type="text" name="fakultas" required>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:10px;">
            <input type="submit" name="submit" value="Simpan">
            <a href="index.php"><button type="button">Kembali</button></a>
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $prodi_jurusan = $_POST['prodi_jurusan'];
        $kode_prodi = $_POST['kode_prodi'];
        $status = $_POST['status'];
        $jenjang = $_POST['jenjang'];
        $kaprodi = $_POST['kaprodi'];
        $fakultas = $_POST['fakultas'];

        // Simpan ke database
        $query = "INSERT INTO prodi (prodi_jurusan, kode_prodi, status, jenjang, kaprodi, fakultas)
                  VALUES ('$prodi_jurusan', '$kode_prodi', '$status', '$jenjang', '$kaprodi', '$fakultas')";
        mysqli_query($koneksi, $query);

        echo "<script>
                alert('Data berhasil disimpan!');
                window.location='index.php';
              </script>";
    }
    ?>
</body>
</html>
