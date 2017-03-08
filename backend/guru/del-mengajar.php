<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM mengajar WHERE ID_GURU='$_GET[idg]' and ID_MP='$_GET[idmp]' and THN_AJAR1='$_GET[thn1]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA GURU BERHASIL DIHAPUS');
					window.location.href='?page=./guru/save-mengajar';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA GURU GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>