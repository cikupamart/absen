<?php
include 'libs/conn.php';
$id   = $_POST['user'];
$nama = $_POST['nama'];
$status = $_POST['status'];
$pass = $_POST['pass'];
$kelas = $_POST['kelas'];

if (!isset($pass)) {
	# code...
	$quer = "UPDATE `sekretaris` SET `nama` = '$nama', `status` = '$status', `kelas` = '$kelas' WHERE `sekretaris`.`username` = '$id'"; 
}else{
	$quer = "UPDATE `sekretaris` SET `nama` = '$nama', `password` = MD5('$pass'), `status` = '$status', `kelas` = '$kelas' WHERE `sekretaris`.`username` = '$id'";
}
$hajar = mysql_query($quer) or die(mysql_error());
if ($hajar) {
	echo "<script>alert('Data Berhasil Di ubah'); window.location='home.php?page=./sekretaris/view';</script>";
}else{
	echo "<script>alert('Data Gagal Di ubah'); window.location='home.php?page=./sekretaris/form&id=$id';</script>";
}
?>