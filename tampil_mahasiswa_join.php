<?php
include "koneksi.php";
$sql = "SELECT m.nim, m.nama, j.nama_jurusan
        FROM mahasiswa m
        LEFT JOIN jurusan j ON m.id_jurusan = j.id_jurusan";
$result = $conn->query($sql);
?>
<table border="1">
<tr><th>NIM</th><th>Nama</th><th>Jurusan</th></tr>
<?php
while($row = $result->fetch_assoc()) {
  echo "<tr><td>{$row['nim']}</td><td>{$row['nama']}</td><td>{$row['nama_jurusan']}</td></tr>";
}
?>
</table>
