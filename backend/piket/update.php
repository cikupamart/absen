<?php
include 'libs/conn.php';
$id   = $_POST['id'];
$nama = $_POST['nama'];
$status = $_POST['status'];
$pass = $_POST['pass'];

if (!isset($pass)) {
	# code...
	$quer = "UPDATE `gpiket` SET `nama` = '$nama', `status` = '$status' WHERE `gpiket`.`id` = '$id'"; 
}else{
	$quer = "UPDATE `gpiket` SET `nama` = '$nama', `password` = MD5('$pass'), `status` = '$status' WHERE `gpiket`.`id` = '$id'";
}
$hajar = mysql_query($quer) or die(mysql_error());
if ($hajar) {
	echo "<script>alert('Data Berhasil Di ubah'); window.location='home.php?page=./piket/view';</script>";
}else{
	echo "<script>alert('Data Gagal Di ubah'); window.location='home.php?page=./piket/form&id=$id';</script>";
}
?>