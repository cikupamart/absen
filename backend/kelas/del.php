<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM kelas WHERE ID_KELAS='$_GET[idk]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA KELAS BERHASIL DIHAPUS');
					window.location.href='?page=./kelas/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA KELAS GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>