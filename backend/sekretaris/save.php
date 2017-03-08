<?php
include 'libs/conn.php';
$cari = mysql_query("SELECT * FROM sekretaris");
	$hancurkan = mysql_num_rows($cari)+1;
	$user = "SKR-00$hancurkan";
$nama = $_POST['nama'];
$pass = $_POST['pass'];
$kelas = $_POST['kelas'];
$quer = "INSERT INTO sekretaris (`id`, `username`, `nama`, `password`, `status`, `kelas`) VALUES (NULL, '$user', '$nama', MD5('$pass'), '1', '$kelas')";
$hajar = mysql_query($quer) or die(mysql_error());
if ($hajar) {
	echo "<script>alert('Data Berhasil Ditambahkan. Username : $user'); window.location='home.php?page=./sekretaris/view';</script>";
}else{
	echo "<script>alert('Data Gagal Ditambahkan'); window.location='home.php?page=./sekretaris/form';</script>";
}
?>