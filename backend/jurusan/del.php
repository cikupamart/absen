<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM jurusan WHERE ID_JURUSAN='$_GET[idk]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA JURUSAN BERHASIL DIHAPUS');
					window.location.href='?page=./jurusan/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA JURUSAN GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>