<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM guru_mp WHERE ID_GURU='$_GET[idguru]'")or die(mysql_error());
	$hapus2=mysql_query("DELETE FROM mengajar WHERE ID_GURU='$_GET[idguru]'")or die(mysql_error());
	if($hapus AND $hapus2){
			echo "<script type=''  language='javascript'>alert('DATA GURU BERHASIL DIHAPUS');
					window.location.href='?page=./guru/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA GURU GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>