<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM gpiket WHERE id='$_GET[id]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA PIKET BERHASIL DIHAPUS');
					window.location.href='?page=./piket/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA PIKET GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>