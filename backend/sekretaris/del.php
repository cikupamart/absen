<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM sekretaris WHERE id='$_GET[id]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA SEKRETARIS BERHASIL DIHAPUS');
					window.location.href='?page=./sekretaris/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA SEKRETARIS GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>