<?php
session_start();
include 'koneksi.php';

$id_foto = $_POST['id_foto'];
$id_user = $_SESSION['id_uder'];
$isi_komentar = $_POST['isi_komentar'];
$tanggal_komenntar = date('Y-m-d');


$query = mysqli_query($koneksi, "INSERT INTO komentar_foto VALUES('','$id_foto','$isi_komentar','$tanggal_komentar')");

echo "<script>
location.href='../admin/index.php';
</script>"

?>