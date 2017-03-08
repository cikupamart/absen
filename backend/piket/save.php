<?php
include 'libs/conn.php';
	$cari = mysql_query("SELECT * FROM gpiket");
	$hancurkan = mysql_num_rows($cari)+1;
	$user = "PKT-00$hancurkan";
$nama = $_POST['nama'];
$pass = $_POST['pass'];

$quer = "INSERT INTO `gpiket` (`id`, `username`, `nama`, `password`, `status`) VALUES (NULL, '$user', '$nama', MD5('$pass'), '1')";
$hajar = mysql_query($quer) or die(mysql_error());
if ($hajar) {
	echo "<script>alert('Data dengan username $user Berhasil Ditambahkan'); window.location='home.php?page=./piket/view';</script>";
}else{
	echo "<script>alert('Data Gagal Ditambahkan'); window.location='home.php?page=./piket/form';</script>";
}
?>