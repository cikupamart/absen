<?php
	include('libs/conn.php');
	$hapus=mysql_query("DELETE FROM mata_pelajaran WHERE ID_MP='$_GET[idk]'")or die(mysql_error());
	if($hapus){
			echo "<script type=''  language='javascript'>alert('DATA MATA PELAJARAN	 BERHASIL DIHAPUS');
					window.location.href='?page=./MATA_PELAJARAN/view';</script>";
		}else{
			echo "<script type=''  language='javascript'>alert('DATA PELAJARAN GAGAL DIHAPUS');
					history.go(-1)</script>";
		}
?>