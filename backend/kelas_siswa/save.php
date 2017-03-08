<?php
	include('libs/conn.php');

$NIS		= $_POST['NIS'];
$ID_KELAS	= $_POST['KELAS'];
$THN_AJAR	= $_POST['THN_AJAR'];


$QUERY = mysql_query("INSERT INTO kelas_siswa VALUES('$NIS','$ID_KELAS','$THN_AJAR')") or die(mysql_error());
if ($QUERY) {
			echo "<script type=''  language='javascript'>alert('DATA KELAS BERHASIL DITAMBAHKAN');
					window.location.href='?page=./kelas_siswa/view';</script>";
}else{
			echo "<script type=''  language='javascript'>alert('DATA KELAS GAGAL DITAMBAHKAN');
					window.location.href='?page=./kelas_siswa/form';</script>";
}
?>