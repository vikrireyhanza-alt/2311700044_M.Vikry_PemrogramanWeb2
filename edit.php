<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id=$id");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Prodi</title>
</head>
<body>
    <h2>Edit Data Program Studi</h2>
    <form method="post" action="">
        <label>Prodi/Jurusan:</label><br>
        <input type="text" name="prodi_jurusan" value="<?php echo $d['prodi_jurusan']; ?>"><br>
        <label>Kode Prodi:</label><br>
        <input type="text" name="kode_prodi" value="<?php echo $d['kode_prodi']; ?>"><br>
        <label>Status:</label><br>
        <select name="status">
            <option value="aktif" <?php if($d['status']=='aktif') echo 'selected'; ?>>Aktif</option>
            <option value="tidak aktif" <?php if($d['status']=='tidak aktif') echo 'selected'; ?>>Tidak Aktif</option>
        </select><br>
        <label>Jenjang:</label><br>
        <input type="text" name="jenjang" value="<?php echo $d['jenjang']; ?>"><br>
        <label>Kaprodi:</label><br>
        <input type="text" name="kaprodi" value="<?php echo $d['kaprodi']; ?>"><br>
        <label>Fakultas:</label><br>
        <input type="text" name="fakultas" value="<?php echo $d['fakultas']; ?>"><br><br>
        <input type="submit" name="update" value="Update">
    </form>

    <?php
    if (isset($_POST['update'])) {
        $prodi_jurusan = $_POST['prodi_jurusan'];
        $kode_prodi = $_POST['kode_prodi'];
        $status = $_POST['status'];
        $jenjang = $_POST['jenjang'];
        $kaprodi = $_POST['kaprodi'];
        $fakultas = $_POST['fakultas'];

        mysqli_query($koneksi, "UPDATE prodi SET 
            prodi_jurusan='$prodi_jurusan',
            kode_prodi='$kode_prodi',
            status='$status',
            jenjang='$jenjang',
            kaprodi='$kaprodi',
            fakultas='$fakultas'
            WHERE id=$id");

        header("Location: index.php");
    }
    ?>
</body>
</html>
